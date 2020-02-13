<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $nickname
 * @property string $fullname
 * @property string|null $photo
 * @property int|null $gender
 * @property string|null $phone_number
 * @property string|null $whatsapp_number
 * @property string|null $address
 * @property string|null $birth_place
 * @property string|null $birth_date
 * @property mixed|null $social_media
 * @property string|null $education_grade
 * @property string|null $education_subject
 * @property string|null $field_of_work
 * @property string|null $status
 * @property string $email
 * @property string|null $provider_name
 * @property string|null $provider_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $district_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEducationGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEducationSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFieldOfWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSocialMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWhatsappNumber($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserEvent[] $events
 * @property-read int|null $events_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserOrganization[] $organizations
 * @property-read int|null $organizations_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Training[] $trainings
 * @property-read int|null $trainings_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserProgram[] $programs
 * @property-read int|null $programs_count
 */
class User extends Authenticatable implements JWTSubject
{
  use Notifiable, SoftDeletes, Auditable;

  protected $hidden = [
    'provider_name',
    'provider_id',
    'created_at',
    'created_by',
    'updated_at',
    'updated_by',
    'deleted_at',
    'deleted_by',
  ];

  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
    return [];
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  public function events()
  {
    return $this->hasMany(UserEvent::class);
  }

  public function organizations()
  {
    return $this->hasMany(UserOrganization::class);
  }

  public function trainings()
  {
    return $this->belongsToMany(Training::class);
  }

  public function programs()
  {
    return $this->hasMany(UserProgram::class);
  }
}
