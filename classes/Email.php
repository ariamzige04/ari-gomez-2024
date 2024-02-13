<?php

namespace Classes;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = s($email);
        $this->nombre = s($nombre);
        $this->token = s($token);
    }

    public function enviarConfirmacion() {
        $mj = new \Mailjet\Client($_ENV['API_KEY'], $_ENV['SECRET_KEY'], true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $_ENV['EMAIL'],
                        'Name' => "AriWeb"
                    ],
                    'To' => [
                        [
                            'Email' => $this->email,
                            'Name' => $this->nombre
                        ]
                    ],
                    'Subject' => "Confirma tu Cuenta",
                    'TextPart' => "Has Registrado Correctamente tu cuenta en AriWeb; pero es necesario confirmarla",
                    'HTMLPart' => "<p><strong>Hola " . $this->nombre .  "</strong>. Has Registrado Correctamente tu cuenta en AriWeb; pero es necesario confirmarla</p>
                                   <p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>
                                   <p>Si tu no creaste esta cuenta; puedes ignorar el mensaje</p>
                                   <img src='https://ssu4y.mjt.lu/img2/ssu4y/2d082691-f1ea-4284-9ea5-ce3dccbc634f/content' alt='Imagen AriWeb'>
                                   ",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];

        $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
        // $response->success() && var_dump($response->getData());
    }

    public function enviarInstrucciones() {
        $mj = new \Mailjet\Client($_ENV['API_KEY'], $_ENV['SECRET_KEY'], true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $_ENV['EMAIL'],
                        'Name' => "AriWeb"
                    ],
                    'To' => [
                        [
                            'Email' => $this->email,
                            'Name' => $this->nombre
                        ]
                    ],
                    'Subject' => "Reestablece tu contraseña",
                    'TextPart' => "Has solicitado reestablecer tu contraseña en AriWeb, sigue el siguiente enlace para hacerlo.",
                    'HTMLPart' => "<p><strong>Hola " . $this->nombre .  "</strong>. Has solicitado reestablecer tu contraseña en AriWeb, sigue el siguiente enlace para hacerlo.</p>
                                   <p>Presiona aquí: <a href='" . $_ENV['HOST'] . "/reestablecer?token=" . $this->token . "'>Reestablecer contraseña</a></p>
                                   <p>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>
                                   <img src='https://ssu4y.mjt.lu/img2/ssu4y/2d082691-f1ea-4284-9ea5-ce3dccbc634f/content' alt='Imagen AriWeb'>
                                   ",
                    'CustomID' => "AppGettingStartedTest"
                ]
            ]
        ];

        $response = $mj->post(\Mailjet\Resources::$Email, ['body' => $body]);
        // $response->success() && var_dump($response->getData());
    }
}
