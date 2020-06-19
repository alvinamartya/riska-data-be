<?php

namespace App\Models;

use App\Constants\Gender;
use Eloquent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $district_id
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBirthPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEducationGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEducationSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFieldOfWork($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProviderName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSocialMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWhatsappNumber($value)
 * @mixin Eloquent
 * @property-read Collection|UserEvent[] $events
 * @property-read int|null $events_count
 * @property-read Collection|UserOrganization[] $organizations
 * @property-read int|null $organizations_count
 * @method static bool|null forceDelete()
 * @method static Builder|User onlyTrashed()
 * @method static bool|null restore()
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 * @property-read Collection|Training[] $trainings
 * @property-read int|null $trainings_count
 * @property-read Collection|UserProgram[] $programs
 * @property-read int|null $programs_count
 * @property-read mixed $district_name
 * @property-read mixed $has_phone
 * @property-read mixed $has_whatsapp
 * @property-read mixed $province_name
 * @property-read mixed $regency_name
 * @property-read mixed $whatsapp_link
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

  protected $appends = [
    'whatsapp_link',
    'has_phone',
    'has_whatsapp',
    'district_name',
    'regency_name',
    'province_name',
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

  public function getGenderAttribute($value)
  {
    if ($value == null) return "-";
    return $value == 0 ? Gender::FEMALE : Gender::MALE;
  }

  public function getHasPhoneAttribute()
  {
    return !empty($this->phone_number);
  }

  public function getHasWhatsappAttribute()
  {
    return !empty($this->whatsapp_number);
  }

  public function getWhatsappLinkAttribute()
  {
    if (empty($this->whatsapp_number)) return "";
    return "https://wa.me/{$this->whatsapp_number}";
  }

  public function getDistrictNameAttribute()
  {
    if (empty($this->district_id)) return null;
    return District::whereId($this->district_id)->first()->name;
  }

  public function getRegencyNameAttribute()
  {
    if (empty($this->district_id)) return null;
    return Regency::whereId(substr($this->district_id, 0, 4))->first()->name;
  }

  public function getProvinceNameAttribute()
  {
    if (empty($this->district_id)) return null;
    return Province::whereId(substr($this->district_id, 0, 2))->first()->name;
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
