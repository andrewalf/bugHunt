<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class QaHelperController extends Controller
{
    public function gitCheckout(Request $request)
    {
        $branch = $request->input('branch');

        if (!$branch) {
            return response()->json(['error' => 'branch param?'], 500);
        }

//        $process = new Process(['git', 'fetch', '--all'], getcwd());
//        $process->run();
//
//        if (!$process->isSuccessful()) {
//            return response()->json(['error' => 'git fetch --all failed'], 500);
//        }

        $process = new Process(['git', 'pull'], getcwd());
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'git pull failed'], 500);
        }

        $process = new Process(['git', 'checkout', $branch], getcwd());
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'git checkout failed'], 500);
        }

        $process = new Process(['git', 'pull'], getcwd());
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json(['error' => 'git pull after git fetch failed'], 500);
        }

        return response()->json(['success' => 'Checked out to ' . $branch], 200);
    }
}