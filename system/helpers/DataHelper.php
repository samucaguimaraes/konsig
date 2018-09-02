<?php

/**
 * @tutorial Classe responsavel por Converte e Calcular
 * datas no formato timestamp, data (dd/mm/aaaa) ou data (dd/mm/aaaa hh:mm:ss).
 * @package HELPERS
 * @author samuel
 */
class DataHelper {
    /*
     * Instancia do Objeto ACTFactory para esta classe.
     */

    private static $instancia = null;

    /**
     * ACTFactory::getInstancia
     *
     * @package system
     * @subpackage helpers
     * @param Void
     * @return Objeto ACTFactory
     * @tutorial: Verifica se existe uma instancia do Objeto ACTFactory, caso contrario
     * da um new e retorna o objeto
     */
    public static function getInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new DataHelper();
        }
        return self::$instancia;
    }

    /**
     * ACTFactory::__clone
     *
     * @package system
     * @subpackage helpers
     * @param Void
     * @return Null
     * @tutorial: Impede que este objeto seja clonado
     * @exception: Clone nao e permitido.
     */
    public function __clone() {
        trigger_error('Clone n�o � permitido.', E_USER_ERROR);
    }

    /**
     * @tutorial Verificar se o valor passado via parametro e um timestamp,
     *  converte para o formato de data formatada e retorna.
     * @param <timeStamp> $data
     * @param <inteiro> $retorno 
     * @return <data> (1)dataHora,(2)data,(3)dia,(4)mes,(5)ano,
     *                (6)dia na semana, (7) nome dia da semana,
     *                (8) nome do mes, (9) data extenso completa
     *                (0)default data
     */
    public static function timeStampParaData($data, $retorno = 0) {
        if (strlen($data) != 10)
            throw new Exception("A Data Informada n�o � um timestamp para a fun��o");
        $data_unformat = $data;

        switch ($retorno) {
            case 1:
                $data_format = date('d/m/Y H:i:s', $data_unformat);
                break;
            case 2:
                $data_format = date('d/m/Y', $data_unformat);
                break;
            case 3:
                $data_format = date('d', $data_unformat);
                break;
            case 4:
                $data_format = date('m', $data_unformat);
                break;
            case 5:
                $data_format = date('Y', $data_unformat);
                break;
            case 6:
                $data_format = date('w', $data_unformat);
                break;
            case 7:
                $data_format = $this->diaSemanaExtenso(date('w', $data_unformat));
                break;
            case 8:
                $data_format = $this->mesExtenso(date('m', $data_unformat));
                break;
            case 9:
                $data_format = date('d', $data_unformat) . ' de ' . DataHelper::mesExtenso(date('m', $data_unformat)) . ' de ' . date('Y', $data_unformat);
                break;
            case 0:
                $data_format = date('d/m/Y', $data_unformat);
                break;
        }
        return $data_format;
    }

    public static function DataParaTimeStamp($data, $delimiter = "/") {
        $data = explode($delimiter, $data);
        $time = mktime(0, 0, 0, $data[1], $data[0], $data[2]);
        return $time;
    }

    /**
     * @tutorial ---.
     * @param ---
     * @param ---
     * @return <data> (1)dataHora,(2)data,(3)dia,(4)mes,(5)ano,
     *                (6)dia na semana, (7) nome dia da semana,
     *                (8) nome do mes, (9) data extenso completa
     *                (0)default data
     */
    public static function obterDiferencaEntreDatas($dataInicio, $dataFim, $delimiter = "/", $retorno = 3) {

        switch ($retorno) {
            case 3:
                $tsDataInicio = DataHelper::DataParaTimeStamp($dataInicio, $delimiter);
                $tsDataFim = DataHelper::DataParaTimeStamp($dataFim, $delimiter);
                $tsDiferenca = $tsDataFim - $tsDataInicio;
                $diferenca = (int) floor(abs($tsDiferenca / (60 * 60 * 24)));
                break;
            case 4:
                $tsDataInicio = DataHelper::DataParaTimeStamp($dataInicio, $delimiter);
                $tsDataFim = DataHelper::DataParaTimeStamp($dataFim, $delimiter);
                $tsDiferenca = $tsDataFim - $tsDataInicio;
                $diferenca = (int) floor(abs($tsDiferenca / (60 * 60 * 24) / 30));
                break;
        }

        return $diferenca;
    }

    /**
     * @tutorial Retorna o nome do dia da semana de acordo com posi��o.
     * Metodo utilizado pela metodo timeStampParaData
     * @access private
     * @param <inteiro> $dia
     * @return <string> dia por extenso
     * do dia passado
     */
    private static function diaSemanaExtenso($dia) {
        $diaExtenso = $dia;
        switch ($dia) {
            case 1:
                $diaExtenso = "Segunda - Feira";
                break;
            case 2:
                $diaExtenso = "Terça - Feira";
                break;
            case 3:
                $diaExtenso = "Quarta - Feira";
                break;
            case 4:
                $diaExtenso = "Quinta - Feira";
                break;
            case 5:
                $diaExtenso = "Sexta - Feira";
                break;
            case 6:
                $diaExtenso = "Sábado - Feira";
                break;
            case 7:
                $diaExtenso = "Domingo - Feira";
                break;
        }
        return $diaExtenso;
    }

    /**
     * @tutorial Retorna o nome do m�s de acordo com o numero  passado.
     * Metodo utilizado pela metodo timeStampParaData
     * @access private
     * @param <inteiro> $mes
     * @return <string> Mes por Extenso
     */
    private static function mesExtenso($mes) {
        $mesExtenso = $mes;
        switch ($mes) {
            case 1:
                $mesExtenso = "Janeiro";
                break;
            case 2:
                $mesExtenso = "Fevereiro";
                break;
            case 3:
                $mesExtenso = "Março";
                break;
            case 4:
                $mesExtenso = "Abril";
                break;
            case 5:
                $mesExtenso = "Maio";
                break;
            case 6:
                $mesExtenso = "Junho";
                break;
            case 7:
                $mesExtenso = "Julho";
                break;
            case 8:
                $mesExtenso = "Agosto";
                break;
            case 9:
                $mesExtenso = "Setembro";
                break;
            case 10:
                $mesExtenso = "Outubro";
                break;
            case 11:
                $mesExtenso = "Novembro";
                break;
            case 12:
                $mesExtenso = "Dezembro";
                break;
        }
        return $mesExtenso;
    }

    /**
     * @tutorial Retorna a data referente a soma de messes em rela��o a data inicial
     * @access private
     * @param <data> $dataInicial
     * @param <mes> $numeroMes
     * @return <string> Mes por Extenso
     */
    public function obterDataNumeroMes($dataInicial, $numeroMes) {
        return $this->DataParaTimeStamp($dataInicial) + (2592000 * $numeroMes);
    }

    public static function diasDiff($dt1, $dt2, $timeZone = 'America/Sao_Paulo') {
        $tZone = new DateTimeZone($timeZone);

        if (is_string($dt1)) {
            $dt1 = new DateTime($dt1, $tZone);
        }
        if (is_string($dt2)) {
            $dt2 = new DateTime($dt2, $tZone);
        }

        // use the DateTime datediff function IF we have a non-buggy version
        // there is a bug in many Windows implementations that diff() always returns 6015  
        if ($dt1->diff($dt1)->format("%a") != 6015) {
            return $dt1->diff($dt2)->format("%a");
        }

        // else let's use our own method
        $y1 = $dt1->format('Y');
        $y2 = $dt2->format('Y');
        $z1 = $dt1->format('z');
        $z2 = $dt2->format('z');

        $diff = intval($y2 * 365.2425 + $z2) - intval($y1 * 365.2425 + $z1);
        return $diff;
    }

    public static function gerarTempoPassado($timeBD) {

        $timeNow = time();
        $timeRes = $timeNow - $timeBD;

        $nar = 0;

        // vari�vel de retorno
        $r = "";

        // Agora
        if ($timeRes == 0) {
            $r = "agora";
        } else
        // Segundos
        if ($timeRes > 0 and $timeRes < 60) {
            $r = $timeRes . " segundos atr&aacute;s";
        } else
        // Minutos
        if (($timeRes > 59) and ( $timeRes < 3599)) {
            $timeRes = $timeRes / 60;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " minuto atr&aacute;s";
            } else {
                $r = round($timeRes, $nar) . " minutos atr&aacute;s";
            }
        } else
        // Horas
        // Usar expressao regular para fazer hora e MEIA
        if ($timeRes > 3559 and $timeRes < 85399) {
            $timeRes = $timeRes / 3600;

            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " hora atr&aacute;s";
            } else {
                $r = round($timeRes, $nar) . " horas atr&aacute;s";
            }
        } else
        // Dias
        // Usar expressao regular para fazer dia e MEIO
        if ($timeRes > 86400 and $timeRes < 2591999) {

            $timeRes = $timeRes / 86400;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " dia atr&aacute;s";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

                if ($matches[2] >= 5) {
                    $ext = round($timeRes, $nar) - 1;

                    // Imprime o dia
                    $r = $ext;

                    // Formata o dia, singular ou plural
                    if ($ext >= 1 and $ext < 2) {
                        $r.= " dia ";
                    } else {
                        $r.= " dias ";
                    }

                    // Imprime o final da data
                    $r.= "&frac12; atr&aacute;s";
                } else {
                    $r = round($timeRes, 0) . " dias atr&aacute;s";
                }
            }
        } else
        // Meses
        if ($timeRes > 2592000 and $timeRes < 31103999) {

            $timeRes = $timeRes / 2592000;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " mes atr&aacute;s";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

                if ($matches[2] >= 5) {
                    $ext = round($timeRes, $nar) - 1;

                    // Imprime o mes
                    $r.= $ext;

                    // Formata o mes, singular ou plural
                    if ($ext >= 1 and $ext < 2) {
                        $r.= " mes ";
                    } else {
                        $r.= " meses ";
                    }

                    // Imprime o final da data
                    $r.= "&frac12; atr&aacute;s";
                } else {
                    $r = round($timeRes, 0) . " meses atr&aacute;s";
                }
            }
        } else
        // Anos
        if ($timeRes > 31104000 and $timeRes < 155519999) {

            $timeRes /= 31104000;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " ano atr&aacute;s";
            } else {
                $r = round($timeRes, $nar) . " anos atr&aacute;s";
            }
        } else
        // 5 anos, mostra data
        if ($timeRes > 155520000) {

            $localTimeRes = localtime($timeRes);
            $localTimeNow = localtime(time());

            $timeRes /= 31104000;
            $gmt = array();
            $gmt['mes'] = $localTimeRes[4];
            $gmt['ano'] = round($localTimeNow[5] + 1900 - $timeRes, 0);

            $mon = array("Jan ", "Fev ", "Mar ", "Abr ", "Mai ", "Jun ", "Jul ", "Ago ", "Set ", "Out ", "Nov ", "Dez ");

            $r = $mon[$gmt['mes']] . $gmt['ano'];
        }

        return $r;
    }

    public static function calcularIdade($dataNascimento) {
        
        // Separa em dia, mês e ano
        list($dia, $mes, $ano) = explode('/', $dataNascimento);

        // Descobre que dia é hoje e retorna a unix timestamp
        $hoje = time(0, 0, 0, date('m'), date('d'), date('Y'));
        // Descobre a unix timestamp da data de nascimento do fulano
        $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);

        // Depois apenas fazemos o cálculo já citado :)
        $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
        
        return $idade;
    }

    public static function gerarTempoFuturo($timeBD) {

        $timeNow = time();
        $timeRes = $timeBD - $timeNow;

        $nar = 0;

        // vari�vel de retorno
        $r = "";

        // Agora
        if ($timeRes == 0) {
            $r = "agora";
        } else
        // Segundos
        if ($timeRes > 0 and $timeRes < 60) {
            $r = $timeRes . " segundos";
        } else
        // Minutos
        if (($timeRes > 59) and ( $timeRes < 3599)) {
            $timeRes = $timeRes / 60;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " minuto";
            } else {
                $r = round($timeRes, $nar) . " minutos";
            }
        } else
        // Horas
        // Usar expressao regular para fazer hora e MEIA
        if ($timeRes > 3559 and $timeRes < 85399) {
            $timeRes = $timeRes / 3600;

            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " hora";
            } else {
                $r = round($timeRes, $nar) . " horas";
            }
        } else
        // Dias
        // Usar expressao regular para fazer dia e MEIO
        if ($timeRes > 86400 and $timeRes < 2591999) {

            $timeRes = $timeRes / 86400;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " dia";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

                if ($matches[2] >= 5) {
                    $ext = round($timeRes, $nar) - 1;

                    // Imprime o dia
                    $r = $ext;

                    // Formata o dia, singular ou plural
                    if ($ext >= 1 and $ext < 2) {
                        $r.= " dia ";
                    } else {
                        $r.= " dias ";
                    }

                    // Imprime o final da data
                    $r.= "1/2";
                } else {
                    $r = round($timeRes, 0) . " dias ";
                }
            }
        } else
        // Meses
        if ($timeRes > 2592000 and $timeRes < 31103999) {

            $timeRes = $timeRes / 2592000;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " mes ";
            } else {

                preg_match('/(\d*)\.(\d)/', $timeRes, $matches);

                if ($matches[2] >= 5) {
                    $ext = round($timeRes, $nar) - 1;

                    // Imprime o mes
                    $r.= $ext;

                    // Formata o mes, singular ou plural
                    if ($ext >= 1 and $ext < 2) {
                        $r.= " mes ";
                    } else {
                        $r.= " meses ";
                    }

                    // Imprime o final da data
                    $r.= "1/2";
                } else {
                    $r = round($timeRes, 0) . " meses ";
                }
            }
        } else
        // Anos
        if ($timeRes > 31104000 and $timeRes < 155519999) {

            $timeRes /= 31104000;
            if (round($timeRes, $nar) >= 1 and round($timeRes, $nar) < 2) {
                $r = round($timeRes, $nar) . " ano ";
            } else {
                $r = round($timeRes, $nar) . " anos ";
            }
        } else
        // 5 anos, mostra data
        if ($timeRes > 155520000) {

            $localTimeRes = localtime($timeRes);
            $localTimeNow = localtime(time());

            $timeRes /= 31104000;
            $gmt = array();
            $gmt['mes'] = $localTimeRes[4];
            $gmt['ano'] = round($localTimeNow[5] + 1900 - $timeRes, 0);

            $mon = array("Jan ", "Fev ", "Mar ", "Abr ", "Mai ", "Jun ", "Jul ", "Ago ", "Set ", "Out ", "Nov ", "Dez ");

            $r = $mon[$gmt['mes']] . $gmt['ano'];
        }

        return $r;
    }

}

?>
