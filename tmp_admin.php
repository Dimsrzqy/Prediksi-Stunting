<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'admin@gmail.com';
$user = App\Models\User::where('email', $email)->first();

if (!$user) {
    App\Models\User::create([
        'name' => 'Super Admin',
        'email' => $email,
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'role' => 'admin'
    ]);
    echo "Admin created with email: admin@gmail.com and password: password123\n";
} else {
    // Force update password
    $user->password = \Illuminate\Support\Facades\Hash::make('password123');
    $user->role = 'admin';
    $user->save();
    echo "Admin password reset! Email: admin@gmail.com, password: password123\n";
}
