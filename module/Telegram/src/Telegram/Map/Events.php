<?php

declare(strict_types=1);

namespace Telegram\Map;

/**
 * Имена событий
 *
 * Class Events
 *
 * @package Telegram\Map
 */
class Events
{
  public const NEW_USER_SENT_REQUEST_TO_JOIN_GROUP = 'NEW_USER_SENT_REQUEST_TO_JOIN_GROUP';
  public const NEW_USER_CREATED_AN_ANSWER_VERIFICATION_QUESTION = 'NEW_USER_CREATED_AN_ANSWER_VERIFICATION_QUESTION';
  public const THE_NEW_USER_ANSWERED_CORRECTLY = 'THE_NEW_USER_ANSWERED_CORRECTLY';
}