<?php

declare(strict_types=1);

namespace App\Traits;

use App\Constants\ErrorCode;
use App\Exceptions\BusinessException;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

trait TokenTrait
{
    private $token;

    private $payLoad;

    /**
     * TokenTrait constructor.
     */
    public function __construct(Request $request)
    {
        $this->token = $request->header('Authorization') ?? '';
    }

    /**
     * @throws \Exception
     * @return mixed
     */
    public function validate()
    {
        try {
            $this->ifEmpty();
            $this->parse();

            JWT::$leeway = config('jwt.leeway');
            JWT::decode($this->token, config('jwt.secret'), ['HS256']);

            return $this->payLoad;
        } catch (\Exception $e) {
            throw new BusinessException(...ErrorCode::USER_NEED_LOGIN);
        }
    }

    /**
     * @throws BusinessException
     */
    public function ifEmpty()
    {
        if (empty($this->token)) {
            throw new BusinessException(...ErrorCode::USER_NEED_LOGIN);
        }
    }

    public function parse()
    {
        $tks = explode('.', $this->token);

        $this->payLoad = (count($tks) === 3) ? JWT::jsonDecode(JWT::urlsafeB64Decode($tks[1])) : [];
    }
}
