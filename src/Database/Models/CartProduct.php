<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\HasApiTokens;

class CartProduct extends BaseModel
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $fillable = [
        'visitor_id',
        'product_id',
        'price',
        'qty'
    ];

    /**
     * CartProduct Belongs to a  visitor if registered.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }



    /**
     * Get the Passport Client for User and If it doesnot exist then create a new one
     * @return \Laravel\Passport\Client $client
     */
    public function getPassportClient()
    {
        $client = $this->clients()->first();
        if (null === $client) {
            $clientRepository = app(ClientRepository::class);
            $redirectUri = asset('');
            $client = $clientRepository->createPasswordGrantClient($this->id, 'Guest', $redirectUri, 'visitors');
        }

        return $client;
    }

    public function findForPassport($username)
    {
        return self::where('username', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return $this->password;
    }
}
