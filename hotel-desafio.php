<?php

/**
 * No caso em questão, foi considerado que Kleber (cliente) contratou o quarto individual e não fez uso do wifi.
 * Foram criadas funções para poder mudar o funcionamento do código como setar que o cliente contratou o wifi, quantos dias de uso fez do wifi, quantas pessoas estavam no quarto com ele e qual o tipo de quarto reservado, sendo fixado a taxa do turismo. 
 */

class Cliente
{

    private $name;
    private $tipoQuarto = 1; # valores entre 1 (individual) e 2 (duplo)
    private $diaEntrada;
    private $diaSaida;
    private $estadia;
    private $usouWifi = 0;
    private $usoWifiDias = 0;

    /**
     * construct
     *
     * @param [string] $name
     * @param [int] $tipoQuarto
     * @param [string] $diaEntrada
     * @param [string] $diaSaida
     */
    public function __construct($name, $tipoQuarto, $diaEntrada, $diaSaida)
    {
        $this->name = $name;
        $this->tipoQuarto = $tipoQuarto;
        $this->diaEntrada = new DateTime($diaEntrada, new DateTimeZone('America/Bahia'));
        $this->diaSaida = new DateTime($diaSaida, new DateTimeZone('America/Bahia'));
        $this->estadia = $this->diaEntrada->diff($this->diaSaida);
    }

    /**
     * getName
     *
     * @param [string] $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * setTipoQuarto
     *
     * @param [int] $tipoQuarto
     * @return void
     */
    public function setTipoQuarto($tipoQuarto)
    {
        $this->tipoQuarto = $tipoQuarto;
    }

    /**
     * setUsouWifi
     *
     * @param [int] $usouWifi
     * @return void
     */
    public function setUsouWifi($usouWifi)
    {
        $this->usouWifi = $usouWifi;
    }

    /**
     * setUsouWifiDias
     *
     * @param [string] $usoWifiDias tem que estar no formato aceitado pelao DateInterval
     * @return void
     */
    public function setUsoWifiDias($usoWifiDias)
    {
        $this->usoWifiDias = new DateInterval($usoWifiDias);
    }

    /**
     * setDiaEntrada
     *
     * @param [string] $diaEntrada tem que estar no formato aceitado pelo DateTime
     * @return void
     */
    public function setDiaEntrada($diaEntrada)
    {
        $this->diaEntrada = new DateTime($diaEntrada, new DateTimeZone('America/Bahia'));
    }

    /**
     * setDiaSaida
     *
     * @param [string] $diaSaida tem que estar no formato aceitado pelo DateTime
     * @return void
     */
    public function setDiaSaida($diaSaida)
    {
        $this->diaSaida = new DateTime($diaSaida, new DateTimeZone('America/Bahia'));
    }
    /**
     * getName
     *
     * @return [string]
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * getDiaEntrada
     *
     * @return [string]
     */
    public function getDiaEntrada()
    {
        return $this->diaEntrada->format('d/m/y');
    }
    /**
     * getEstadia
     *
     * @return [string]
     */
    public function getEstadia()
    {
        return $this->estadia->days;
    }
    /**
     * getDiaSaida
     *
     * @return [string]
     */
    public function geDiaSaida()
    {
        return $this->diaSaida->format('d/m/y');
    }

    /**
     * getUsouWifi
     *
     * @return [boolean]
     */
    public function getUsouWifi()
    {
        return !!$this->usouWifi;
    }

    /**
     * getUsoWifiDias
     *
     * @return [string]
     */
    public function getUsoWifiDias()
    {
        return $this->usoWifiDias->d;
    }

    /**
     * getTipoQuarto
     *
     * @return [int]
     */
    public function getTipoQuarto()
    {
        return $this->tipoQuarto;
    }
}
class Hotel
{

    private const QUARTO_INDIVIDUAL = 100.00;
    private const QUARTO_DUPLO = 150.00;
    private const TAXA_SERVICO = 0.05;
    private const TAXA_TURISMO = 10.00;
    private const TAXA_WIFI = 20.00;
    private $pessoasNoQuarto = 1; # no mínimo tera uma pessoa no quarto o mesmo for reservado

    /**
     * getPessoasNoQuarto
     *
     * @return [int]
     */
    public function getPessoasNoQuarto()
    {
        return $this->pessoasNoQuarto;
    }

    /**
     * calculaValorFinal
     * Calcula o valor a ser pago pelo clinte que fez uso do quarto
     * 
     * @param Cliente $cliente
     * @return [float]
     */
    public function calculaValorFinal(Cliente $cliente)
    {
        if ($cliente->getTipoQuarto() == 1) {
            return ($cliente->getEstadia() * $this::QUARTO_INDIVIDUAL)
                + ($cliente->getEstadia() * ($this::TAXA_SERVICO * $this::QUARTO_INDIVIDUAL))
                + ($cliente->getEstadia() * $this::TAXA_TURISMO)
                + ($cliente->getEstadia() * $this::TAXA_TURISMO * $this->getPessoasNoQuarto())
                + ($this->usouWifi ? $this->usoWifiDias * $this::TAXA_WIFI : 0);
        } else {
            return ($cliente->getEstadia() * $this::QUARTO_DUPLO)
                + ($cliente->getEstadia() * ($this::TAXA_SERVICO * $this::QUARTO_INDIVIDUAL))
                + ($cliente->getEstadia() * $this::TAXA_TURISMO)
                + ($cliente->getEstadia())
                + ($cliente->getEstadia() * $this::TAXA_TURISMO * $this->getPessoasNoQuarto())
                + ($cliente->getUsouWifi() ? $cliente->usoWifiDias() * $this::TAXA_WIFI : 0);
        }
    }
}

$cliente = new Cliente('Klebler', 1, '24-12-2019', '27-12-2019');
$hotel = new Hotel();

echo "O valor pago por {$cliente->getName()} será de R$" . floatval($hotel->calculaValorFinal($cliente));
echo "\n";
