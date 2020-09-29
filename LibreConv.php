<?php


    /**
     * author: Tom Oliveira
     * 
     * é necessário ter o libreoffice instalado
     * 
     * o que é cada atributo no Construtor
     * @var string $execute, passar o path de ambiente do libreoffice, EX: soffice ou libreoffice
     * @var string $extension, para qual extensao deverá ser convertida
     * @var string $pathFile, o local da pasta do arquivo que deve ser convertido
     * @var string $outDir, para onde o arquivo deve ser enviado
     * 
     * Alterar o namespace de acordo com o projeto que isso será inserido
     * 
     * versão: beta
     * 
     * PHP: ^7.4
     * Libreoffice: ^7.*
     */

    namespace App\Service;


class LibreConv{
        
        private string $execute;
        private string $extension;
        private string $pathFile;
        private string $outDir;

        public function __construct(
            string $execute = 'soffice',
            string $extension = 'pdf',
            string $pathFile = '/',
            string $outDir = '/'
        ){
            $this->execute = $execute;
            $this->extension = $extension;
            $this->pathFile = $pathFile;
            $this->outDir = $outDir;
        }

        public function execute() : bool{
            $this->validate();
            $cmd = "{$this->execute} --headless --convert-to {$this->extension} {$this->pathFile} --outdir {$this->outDir}";
            $headless = popen($cmd, 'w');
            pclose($headless);
            
            return true;
        }

        private function validate() : void {

            if(!is_dir($this->outDir)){
                throw new \Exception('Esse diretório não existe');
            }
        }
    }

?>