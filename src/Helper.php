<?php

declare(strict_types=1);

namespace Koempf\PixiClient;

use Symfony\Component\Serializer\Encoder\XmlEncoder;

class Helper
{
    public static function arrayToXml(array $data, string $rootName): string
    {
        $encoder = new XmlEncoder();
        return $encoder->encode($data, 'normal', [
            'xml_root_node_name' => $rootName,
            'xml_format_output' => true,
        ]);
    }
}
