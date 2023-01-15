<?php

Route::get('/{any}',MainController::class)->where('any', '.*');
