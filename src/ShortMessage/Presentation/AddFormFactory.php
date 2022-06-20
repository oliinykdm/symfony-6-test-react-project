<?php declare(strict_types=1);

namespace App\ShortMessage\Presentation;

use Symfony\Component\HttpFoundation\Request;

final class AddFormFactory
{
    public function createFromRequest(Request $request): AddForm
    {
        return new AddForm(
            (string)$request->get('message_text'),
            1
        );
    }
}