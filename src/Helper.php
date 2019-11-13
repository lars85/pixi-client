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

    public static function createDateTime(?string $dateTimeString): ?\DateTime
    {
        if (empty($dateTimeString) || $dateTimeString === '1970-01-01T00:00:00') {
            return null;
        }

        return new \DateTime($dateTimeString, new \DateTimeZone('Europe/Berlin'));
    }
}
