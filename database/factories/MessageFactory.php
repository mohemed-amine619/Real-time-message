<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderId = $this->faker->randomElement([0, 1]);
        if($senderId === 0){
            $senderId = $this->faker->randomElement(\App\Models\User::where('sender_id' , '!=' , 1)->pluck('id')->toArray());
            $reciverId = 1;
        }else{
            $reciverId = $this->faker->randomElement(\App\Models\User::pluck('id')->toArray());
        }

        $groupId = null;
        if($this -> faker ->boolean(50)) {
            $groupId = $this -> faker ->randomElement(\App\Models\Group::pluck("id")->toArray());
            // select group by group_id
            $group = \App\Models\Group::find($groupId);
            $senderId = $this->faker->randomElement($group->users->pluck('id')->toArray());
            $reciverId = null;
        }
        return [
            'sender_id' => $senderId,
            'reciver_id' => $reciverId,
            'group_id' => $groupId,
            'message' => $this->faker->realText(300),
            'created_at' => $this->faker->dateTimeBetween('-1 year' , 'now'),
        ];
    }
}
