<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessExportProducts;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ProductExportController extends Controller
{
    private const CHUNK_SIZE = 1000;

    public function index()
    {
        ProcessExportProducts::dispatch(self::CHUNK_SIZE);
    }
}