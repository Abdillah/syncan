<?php
namespace App\Controller;

use Interop\Container\ContainerInterface;

class UploadController
{
    protected $app;

    public function __construct(ContainerInterface $app) {
        $this->app = $app;
        $this->renderer = $app->get('renderer');
        $this->logger = $app->get('logger');
    }

    private function getProfileList($dir)
    {
        $files = [];
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (!is_dir($file) && pathinfo($file, PATHINFO_EXTENSION) == 'ini') {
                    array_push($files, basename($file, '.ini'));
                }
            }
            closedir($dh);
        }
        return $files;
    }

    public function view($request, $response, $args) {
        $profilePath = $this->app->get('settings')['connectionProfile']['profile_path'];

        $profile = $args['profile'];
        $profileList = $this->getProfileList($profilePath);
        $profileSelected = array_search($profile, $profileList);

        if (!$profileSelected) {
            $profileSelected = 0;
        }

        $profileFile = $profilePath . $profileList[$profileSelected] . '.ini';
        $profileConfig = parse_ini_file($profileFile);

        $viargs = [
            'profileIndex' => $profileSelected,
            'profileList' => $profileList,
            'profileSelected' => $profileConfig
        ];

        return $this->renderer->render($response, 'upload.twig', $viargs);
    }
}
