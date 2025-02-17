<?php

/**
 * RPCErrorException module.
 *
 * This file is part of MadelineProto.
 * MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU General Public License along with MadelineProto.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    Daniil Gentili <daniil@daniil.it>
 * @copyright 2016-2019 Daniil Gentili <daniil@daniil.it>
 * @license   https://opensource.org/licenses/AGPL-3.0 AGPLv3
 *
 * @link      https://docs.madelineproto.xyz MadelineProto documentation
 */

namespace danog\MadelineProto;

class RPCErrorException extends \Exception
{
    use TL\PrettyException;
    private $fetched = false;
    public static $rollbar = true;

    public function getMess()
    {
        if ($this->fetched === false) {
            $res = json_decode(@file_get_contents('https://rpc.pwrtelegram.xyz/?method='.$additional[0].'&code='.$code.'&error='.$this->rpc), true);
            if (isset($res['ok']) && $res['ok']) {
                $this->message = $res['result'];
            }
        }

        return $this->message;
    }

    public function __toString()
    {
        $result = sprintf(\danog\MadelineProto\Lang::$current_lang['rpc_tg_error'], $this->getMess(), $this->rpc, $this->file, $this->line.PHP_EOL.PHP_EOL).PHP_EOL.\danog\MadelineProto\Magic::$revision.PHP_EOL.$this->getTLTrace().PHP_EOL;
        if (php_sapi_name() !== 'cli') {
            $result = str_replace(PHP_EOL, '<br>'.PHP_EOL, $result);
        }
        return $result;
    }

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
        $this->rpc = $message;
        switch ($message) {
            case 'RPC_MCGET_FAIL':
            case 'RPC_CALL_FAIL':
                $message = 'Telegram is having internal issues, please try again later.';
                break;
            case 'USER_PRIVACY_RESTRICTED':
                $message = "The user's privacy settings do not allow you to do this";
                break;
            case 'CHANNEL_PRIVATE':
                $message = "You haven't joined this channel/supergroup";
                break;
            case 'FLOOD_WAIT_666':
                $message = 'Spooky af m8';
                break;
            case 'USER_IS_BOT':
                $message = "Bots can't send messages to other bots";
                break;
            case 'BOT_METHOD_INVALID':
                $message = 'This method cannot be run by a bot';
                break;
            case 'PHONE_CODE_EXPIRED':
                $message = 'The phone code you provided has expired, this may happen if it was sent to any chat on telegram (if the code is sent through a telegram chat (not the official account) to avoid it append or prepend to the code some chars)';
                break;
            case 'USERNAME_INVALID':
                $message = 'The provided username is not valid';
                break;
            case 'ACCESS_TOKEN_INVALID':
                $message = 'The provided token is not valid';
                break;
            case 'ACTIVE_USER_REQUIRED':
                $message = 'The method is only available to already activated users';
                break;
            case 'FIRSTNAME_INVALID':
                $message = 'The first name is invalid';
                break;
            case 'LASTNAME_INVALID':
                $message = 'The last name is invalid';
                break;
            case 'PHONE_NUMBER_INVALID':
                $message = 'The phone number is invalid';
                break;
            case 'PHONE_CODE_HASH_EMPTY':
                $message = 'phone_code_hash is missing';
                break;
            case 'PHONE_CODE_EMPTY':
                $message = 'phone_code is missing';
                break;
            case 'PHONE_CODE_EXPIRED':
                $message = 'The confirmation code has expired';
                break;
            case 'API_ID_INVALID':
                $message = 'The api_id/api_hash combination is invalid';
                break;
            case 'PHONE_NUMBER_OCCUPIED':
                $message = 'The phone number is already in use';
                break;
            case 'PHONE_NUMBER_UNOCCUPIED':
                $message = 'The phone number is not yet being used';
                break;
            case 'USERS_TOO_FEW':
                $message = 'Not enough users (to create a chat, for example)';
                break;
            case 'USERS_TOO_MUCH':
                $message = 'The maximum number of users has been exceeded (to create a chat, for example)';
                break;
            case 'TYPE_CONSTRUCTOR_INVALID':
                $message = 'The type constructor is invalid';
                break;
            case 'FILE_PART_INVALID':
                $message = 'The file part number is invalid';
                break;
            case 'FILE_PARTS_INVALID':
                $message = 'The number of file parts is invalid';
                break;
            case 'MD5_CHECKSUM_INVALID':
                $message = 'The MD5 checksums do not match';
                break;
            case 'PHOTO_INVALID_DIMENSIONS':
                $message = 'The photo dimensions are invalid';
                break;
            case 'FIELD_NAME_INVALID':
                $message = 'The field with the name FIELD_NAME is invalid';
                break;
            case 'FIELD_NAME_EMPTY':
                $message = 'The field with the name FIELD_NAME is missing';
                break;
            case 'MSG_WAIT_FAILED':
                $message = 'A waiting call returned an error';
                break;
            case 'USERNAME_NOT_OCCUPIED':
                $message = 'The provided username is not occupied';
                break;
            case 'PHONE_NUMBER_BANNED':
                $message = 'The provided phone number is banned from telegram';
                break;
            case 'AUTH_KEY_UNREGISTERED':
                $message = 'The authorization key has expired';
                break;
            case 'INVITE_HASH_EXPIRED':
                $message = 'The invite link has expired';
                break;
            case 'USER_DEACTIVATED':
                $message = 'The user was deactivated';
                break;
            case 'USER_ALREADY_PARTICIPANT':
                $message = 'The user is already in the group';
                break;
            case 'MESSAGE_ID_INVALID':
                $message = 'The provided message id is invalid';
                break;
            case 'PEER_ID_INVALID':
                $message = 'The provided peer id is invalid';
                break;
            case 'CHAT_ID_INVALID':
                $message = 'The provided chat id is invalid';
                break;
            case 'MESSAGE_DELETE_FORBIDDEN':
                $message = "You can't delete one of the messages you tried to delete, most likely because it is a service message.";
                break;
            case 'CHAT_ADMIN_REQUIRED':
                $message = 'You must be an admin in this chat to do this';
                break;
            case -429:
            case 'PEER_FLOOD':
                $message = 'Too many requests';
                break;
        }
        parent::__construct($message, $code, $previous);
        $this->prettify_tl();
        $additional = [];
        foreach ($this->getTrace() as $level) {
            if (isset($level['function']) && $level['function'] === 'method_call') {
                $this->line = $level['line'];
                $this->file = $level['file'];
                $additional = $level['args'];
                break;
            }
        }
        if ($this->rpc !== $message) {
            $this->fetched = true;
        }
        if (!self::$rollbar) {
            return;
        }
        if (in_array($this->rpc, ['CHANNEL_PRIVATE', -404, -429, 'USERNAME_NOT_OCCUPIED', 'ACCESS_TOKEN_INVALID', 'AUTH_KEY_UNREGISTERED', 'SESSION_PASSWORD_NEEDED', 'PHONE_NUMBER_UNOCCUPIED', 'PEER_ID_INVALID', 'CHAT_ID_INVALID', 'USERNAME_INVALID', 'CHAT_WRITE_FORBIDDEN', 'CHAT_ADMIN_REQUIRED', 'PEER_FLOOD'])) {
            return;
        }
        if (strpos($this->rpc, 'FLOOD_WAIT_') !== false) {
            return;
        }
        $message === 'Telegram is having internal issues, please try again later.' ? \Rollbar\Rollbar::log(\Rollbar\Payload\Level::critical(), $message) : \Rollbar\Rollbar::log(\Rollbar\Payload\Level::error(), $this, $additional);
    }
}
