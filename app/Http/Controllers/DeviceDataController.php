<?php

namespace App\Http\Controllers;

use App\Models\CallLog;
use App\Models\Device;
use App\Models\DeviceLocation;
use App\Models\GalleryEntry;
use App\Models\MessageLog;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    public function postCurrentLocation($id, Request $request)
    {
        $request->validate([
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        $device = Device::findOrFail($id);

        $deviceLocation = new DeviceLocation([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        $device->locations()->save($deviceLocation);

        return response()->json(['message' => 'Current location stored successfully']);
    }

    public function getLocationHistory($id)
    {
        $locationHistory = DeviceLocation::where('device_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['location_history' => $locationHistory]);
    }

    public function getGeofencingAlerts($id)
    {
        // Logic to fetch geofencing alerts for the device with ID $id
    }

    public function storeMessageLogs($id, Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date_time' => 'required|date',
        ]);
    
        $device = Device::findOrFail($id);
    
        $messageLog = new MessageLog([
            'from' => $request->from,
            'to' => $request->to,
            'date_time' => $request->date_time,
        ]);
    
        $device->messageLogs()->save($messageLog);
    
        return response()->json(['message' => 'Message log stored successfully']);
    }

    public function getMessagesLogs($id)
    {
        $device = Device::findOrFail($id);

        $messageLogs = $device->messageLogs;

        return response()->json(['message_logs' => $messageLogs]);
    }

    public function storeCallLogs($id, Request $request)
    {
        $request->validate([
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'date_time' => 'required|date',
        ]);
    
        $device = Device::findOrFail($id);
    
        $callLog = new CallLog([
            'from' => $request->from,
            'to' => $request->to,
            'date_time' => $request->date_time,
        ]);
    
        $device->callLogs()->save($callLog);
    
        return response()->json(['message' => 'Message log stored successfully']);
    }


    public function getCallLogs($id)
    {
        $device = Device::findOrFail($id);

        $callLogs = $device->callLogs;

        return response()->json(['callLogs' => $callLogs]);
    }

    public function storeGalleryEntry($id, Request $request)
    {
        $request->validate([
            'file' => 'required|file', // Adjust validation rules as needed
            'file_type' => 'required|string', // Add validation rules for file type if needed
        ]);

        $device = Device::findOrFail($id);

        $file = $request->file('file');
        $filePath = $file->store('gallery', 'public');

        $galleryEntry = new GalleryEntry([
            'file_path' => $filePath,
            'file_type' => $request->file_type,
        ]);

        $device->galleryEntries()->save($galleryEntry);

        return response()->json(['message' => 'Gallery entry stored successfully']);
    }

    public function fetchGalleryEntries($id)
    {
        $device = Device::findOrFail($id);

        $galleryEntries = $device->galleryEntries;

        return response()->json(['gallery_entries' => $galleryEntries]);
    }

}
