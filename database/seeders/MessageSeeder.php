<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Message;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Confirmed",
            'title' => "Confirmed",
            'message' => "You're Order is confirmed.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Preparing",
            'title' => "Preparing",
            'message' => "We're preparing your order.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Pick-Up",
            'title' => "Pick-Up",
            'message' => "You're ROZA order is on its way.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Arrived",
            'title' => "Arrived",
            'message' => "Our rider has now arrived at your location.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Delivered",
            'title' => "Delivered",
            'message' => "You're Order is delivered.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "Notification",
            'status' => "Cancelled",
            'title' => "Cancelled",
            'message' => "You're Order is cancelled.",
            'record_by' => 1,
        ]);
        Message::create([
            'business_id' => "1",
            'type' => "SMS",
            'status' => "Confirmed",
            'title' => "Confirmed",
            'message' => "Your order is confirmed. We will let you know when our rider is on his way.",
            'record_by' => 1,
        ]);
    }
}
