<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use OpenApi\Annotations as OA;
    use Tymon\JWTAuth\Contracts\JWTSubject;

    /**
     * @OA\Schema(
     *     schema="User",
     *     type="object",
     *     title="User",
     *     description="User model",
     *     required={"id", "name", "email"},
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *         description="The unique identifier of the user",
     *         example=1
     *     ),
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="The name of the user",
     *         example="John Doe"
     *     ),
     *     @OA\Property(
     *         property="email",
     *         type="string",
     *         description="The email of the user",
     *         example="john.doe@example.com"
     *     ),
     *     @OA\Property(
     *         property="email_verified_at",
     *         type="string",
     *         format="date-time",
     *         description="Timestamp when the email was verified",
     *         example="2024-08-12T19:32:45.000000Z"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         type="string",
     *         format="date-time",
     *         description="Timestamp when the user was created",
     *         example="2024-08-12T19:32:45.000000Z"
     *     ),
     *     @OA\Property(
     *         property="updated_at",
     *         type="string",
     *         format="date-time",
     *         description="Timestamp when the user was last updated",
     *         example="2024-08-12T19:32:45.000000Z"
     *     )
     * )
     */
    class User extends Authenticatable implements JWTSubject
    {
        use HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array<int, string>
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * Get the attributes that should be cast.
         *
         * @return array<string, string>
         */
        protected function casts(): array
        {
            return [
                'email_verified_at' => 'datetime',
                'password' => 'hashed',
            ];
        }

        /**
         * Get the identifier that will be stored in the JWT.
         */
        public function getJWTIdentifier()
        {
            return $this->getKey();
        }

        /**
         * Return a key-value array, containing any custom claims to be added to the JWT.
         */
        public function getJWTCustomClaims()
        {
            return [];
        }
    }

