<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Service;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.dashboard');
    }

    public function showAppointments()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();
        return view('client.appointments.index', compact('appointments'));
    }

    public function createAppointment()
    {
        $services = Service::all();
        return view('client.appointments.create', compact('services'));
    }

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after:today',
        ]);

        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
        ]);

        return redirect()->route('client.appointments')->with('success', 'Wizyta została zaplanowana.');
    }

    public function editAppointment(Appointment $appointment)
    {
        $this->authorize('update', $appointment);
        $services = Service::all();
        return view('client.appointments.edit', compact('appointment', 'services'));
    }

    public function updateAppointment(Request $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after:today',
        ]);

        $appointment->update([
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
        ]);

        return redirect()->route('client.appointments')->with('success', 'Wizyta została zaktualizowana.');
    }

    public function destroyAppointment(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $appointment->delete();

        return redirect()->route('client.appointments')->with('success', 'Wizyta została anulowana.');
    }
}
