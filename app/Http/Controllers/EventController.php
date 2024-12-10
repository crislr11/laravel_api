<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisteredEventsMail;

class EventController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('event.createEvent', compact('categories'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $event = Event::findOrFail($id);
        return view('event.editEvent', compact('event', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
        ]);

        $event->title = $request->title;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->latitude = $request->latitude;
        $event->longitude = $request->longitude;
        $event->max_attendees = $request->max_attendees;
        $event->price = $request->price;

        // Manejar la imagen si se proporciona
        if ($request->hasFile('image_url')) {
            $event->image_url = $request->file('image_url')->store('storage/images', 'public');
        } 

        // Asociar el evento al usuario autenticado
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento actualizado con éxito');
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('organizer')->with('success', 'Evento eliminado con éxito');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->rol == 'o') {
            $events = Event::where('organizer_id', $user->id)->get(); // Obtener solo los eventos del organizador
            $categories = Category::all(); // Obtener todas las categorías
            return view('user.organizerEvents', compact('events', 'categories')); // Asegúrate de que la vista exista
    
        } else if($user->rol == 'u'){

            $title = 'Eventos disponibles';
            $events = Event::whereDoesntHave('attendees', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('start_time', '>', now())
            ->get(); 
            
            $categories = Category::all(); 
            return view('user.normalUser', compact('events', 'categories', 'title')); // Asegúrate de que la vista exista
        }
        return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
    }

    public function filterByCategory(string $categoryName)
    {
        $user = Auth::user();
        if ($user->rol !== 'o') {
            return redirect()->route('home')->with('error', 'No tienes acceso a esta sección.');
        }
        if ($categoryName === 'All') {
            return redirect()->route('organizer');
        }
        $category = Category::where('name', $categoryName)->firstOrFail();
        $events = Event::where('category_id', $category->id)->get();
        return view('user.organizerEvents', compact('events', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'location' => 'required|string|max:255',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'max_attendees' => 'required|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:5000',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->category_id = $request->category_id;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;
        $event->latitude = $request->latitude;
        $event->longitude = $request->longitude;
        $event->max_attendees = $request->max_attendees;
        $event->price = $request->price;

        // Manejar la imagen si se proporciona
        if ($request->hasFile('image_url')) {
            $event->image_url = $request->file('image_url')->store('storage/images', 'public');
        } else {
            $event->image_url = 'storage/images/interrogante.jpg';
        }

        // Asociar el evento al usuario autenticado
        $event->organizer_id = Auth::id();
        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente');
    }

    public function registeredEvents()
    {
        $user = Auth::user(); 
        $title = 'Eventos registrados';
        $events = Event::whereHas('attendees', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('start_time', '>', now())
        ->get();

        $categories = Category::all(); 
        return view('user.normalUser', compact('events', 'categories', 'title'));
    }

    public function toggleRegistration($eventId)
    {
        $user = Auth::user(); 
        $event = Event::findOrFail($eventId); 

        // Verifica si el usuario ya está registrado en el evento
        $existingRegistration = $event->attendees()->where('user_id', $user->id)->first();

        if ($existingRegistration) {
            // Si ya está registrado, se cancela la inscripción
            $event->attendees()->detach($user->id);
            $message = "Te has desinscrito del evento.";
        } else {
            // Si no está registrado, el usuario se registra
            $event->attendees()->attach($user->id, ['status' => 'confirmed', 'registered_at' => now()]);
            $message = "Te has inscrito en el evento.";
        }

        // Redirige con un mensaje
        return back()->with('message', $message);
    }

    public function generatePdf()
    {
        $user = Auth::user();
        $events = Event::whereHas('attendees', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('start_time', '>', now())->get();

        $pdf = Pdf::loadView('pdf.registeredEvents', compact('user', 'events'));

        return $pdf->download('registered_events.pdf');
    }

    public function sendPdfByEmail()
    {
        $user = Auth::user();
        $events = Event::whereHas('attendees', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('start_time', '>', now())->get();

        // Genera el PDF
        $pdf = Pdf::loadView('pdf.registeredEvents', compact('user', 'events'));

        // Enviar el correo con el PDF adjunto
        Mail::to($user->email)->send(new RegisteredEventsMail($pdf, $user));

        return back()->with('success', 'El PDF con los eventos registrados ha sido enviado a tu correo.');
    }
}
