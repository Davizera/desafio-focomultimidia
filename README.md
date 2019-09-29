# Requisitos

1.  Você deverá ter instalado terminal do git
1.  Você deverá ter instalado o docker

# Instalação

1.  Link para fazer a instalação do terminal do git no windows <https://git-scm.com/download/win>, caso esteja usando um sistema operacional linux o git provavelmente já estará instalado, caso contrário você podera encontrar tutorias
    ao pesquisa algo como `install git on {current OS}`
2.  Para instalar o dokcer você pode ir nesse link e efetuar o processo de instalação de acordo com seu sistema
    operacional [link](https://docs.docker.com/install/)

# Instruções

1. Feito as etapas anteriores, podemos partir para próxima etapa que é clonar o repositório em sua máquina, copie esse
   trecho em seu terminal do git `git clone https://github.com/Davizera/desafio-focomultimidia.git`
2. Após finalizado o comando, terá sido criado uma pasta com o nome `desafio-focomultimidia` no diretório corrente entre nela usando o `cd desafio-focomultimidia`
3. Então agora estamos habilitados a usar o comando `[sudo] (caso esteja usando ambiente linux) docker run --rm --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.2-cli php hotel-desafio.php` para executar o script com o algoritmo do desafio
4. O script php será executado em seu terminal então olhe a saída gera
5. (Opcional) Caso queira verificar o código feito execute o comando `cat hotel-desafio.php`
