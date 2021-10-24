<?php
namespace AvoRed\Framework\Database\Traits;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait UuidTrait
{
    public function initializeUuidTrait(): void
    {
        $this->setIncrementing(false);
        $this->setKeyType('string');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootUuidTrait()
    {
        self::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4()->toString());
        });
    }
}
