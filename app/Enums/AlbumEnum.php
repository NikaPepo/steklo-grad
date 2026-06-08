<?php
declare(strict_types=1);
namespace App\Enums;
enum AlbumEnum: string{
    case WelcomeAlbum = 'glavnaia-stranica';
    case BannerAlbum = 'glavnaia-banner';
    case GalleryPreviewAlbum = 'glavnaia-galereia';
    case ServiceAlbum = 'service';
}