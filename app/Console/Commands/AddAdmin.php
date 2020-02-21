<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Validator;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:add {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $email = $this->argument('email');
      $validator = Validator::make(['email' => $email], ['email' => 'required|email']);
      if ($validator->fails()) {
        $this->error('Email is not valid!');
        return;
      }

      $user = User::whereEmail($this->argument('email'))->first();
      if (!$user) {
        $this->comment("Email is not registered yet, we will create it for you");
        $newUser = new User();
        $newUser->email = $email;
        $newUser->fullname = $this->ask('Fullname');
        $newUser->save();

        $user = $newUser;
      }
      $role = Role::whereId(1)->first();
      if ($role->users->contains($user->id)) {
        $this->comment("{$user->fullname} already attached to {$role->name}");
        return;
      }
      $role->users()->attach($user->id, ['is_active' => true, 'expired_at' => null]);
      $this->comment("{$user->fullname} attached to {$role->name}");
      return;
    }
}
