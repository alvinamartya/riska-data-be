<?php

namespace App\Constants;

use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class RestResponse
{
  static function message(String $message, int $code = HttpStatusCode::OK) {
    return self::data(["message" => $message], $code);
  }

  static function error(\Exception $e, int $code = HttpStatusCode::SERVER_ERROR) {
    return response()->json($e, $code);
  }

  static function conflict(String $message) {
    return response()->json(new ConflictHttpException($message), HttpStatusCode::CONFLICT);
  }

  static function unauthorized(String $message = "You are not authorized to do this!") {
    return response()->json(new AccessDeniedHttpException($message), HttpStatusCode::UNAUTHORIZED);
  }

  static function data($data, int $code = HttpStatusCode::OK) {
    return response()->json($data, $code);
  }

  static function created($entity) {
    return self::message(sprintf("%s successfully created", self::getEntityName($entity)), HttpStatusCode::CREATED);
  }

  static function updated($entity) {
    return self::message(sprintf("%s successfully updated", self::getEntityName($entity)));
  }

  static function deleted($entity) {
    return self::message(sprintf("%s successfully deleted", self::getEntityName($entity)));
  }

  static function attached($entityParent, $entityChild) {
    return self::message(sprintf("%s successfully attached to this %s", self::getEntityName($entityChild), self::getEntityName($entityParent)), HttpStatusCode::CREATED);
  }

  static function uptached($entityParent, $entityChild) {
    return self::message(sprintf("Detail attached %s for this %s updated", self::getEntityName($entityChild), self::getEntityName($entityParent)));
  }

  static function detached($entityParent, $entityChild) {
    return self::message(sprintf("%s successfully detached from this %s", self::getEntityName($entityChild), self::getEntityName($entityParent)));
  }

  private static function getEntityName($entity) {
    try {
      $reflection = new ReflectionClass($entity);
      return $reflection->getShortName();
    } catch (\ReflectionException $e) {
      return is_string($entity) ? $entity : "Unknown";
    }
  }
}
