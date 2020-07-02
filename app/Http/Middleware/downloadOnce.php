<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Cache\CacheManager as Cache;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Routing\Middleware\ValidateSignature; 

class ValidateSignature 
{
    /**
     * Cache manager
     *
     * @var \Illuminate\Cache\CacheManager
     */
    protected $cache;

    /**
     * Create a new ValidateSignature instance.
     *
     * @param  \Illuminate\Cache\CacheManager $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  bool $consume
     * @return \Illuminate\Http\Response
     *
     */
    public function handle($request, Closure $next, $consume = false)
    {
        if (($consume && $this->signatureConsumed($request)) || !$request->hasValidSignature()) {
            throw new InvalidSignatureException;
        }

        /** @var \Illuminate\Http\Response $response */
        $response = $next($request);

        if ($consume && $response->isSuccessful()) {
            $this->consumeSignature($request);
        }


        return $response;
    }

    /**
     * Checks if the signature was consumed
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected function signatureConsumed(Request $request)
    {
        return $this->cache->driver('file')->has($this->cacheKey($request));
    }

    /**
     * Consumes the signature, marking it as unavailable
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    protected function consumeSignature(Request $request)
    {
        $ttl = Carbon::createFromTimestamp($request->query('expires'));

        $this->cache->driver('file')->put($this->cacheKey($request), null, $ttl);
    }

    /**
     * Return the cache Key to check
     *
     * @param  \Illuminate\Http\Request $request
     * @return string
     */
    protected function cacheKey(Request $request)
    {
        return 'consumable|' . $request->query('signature');
    }
}