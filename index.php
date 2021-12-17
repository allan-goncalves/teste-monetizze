<?php 


class TesteMonetizze {

    private $quantidadeDeDezenas;
    private $resultado;
    private $totalDeJogos;
    private $jogos;

    public function __construct(array $quantidadeDeDezenas, $totalDeJogos) {
        try { 
            for($i=0;$i<count($quantidadeDeDezenas);$i++){
                if (count($quantidadeDeDezenas[$i]) < 5 || count($quantidadeDeDezenas[$i]) > 10) { 
                    throw new Exception('Quantidade de dezenas não permitida. Digite de 6 a 10 dezenas.');
                }
            }

            $this->setQuantidadeDeDezenas($quantidadeDeDezenas);
            $this->setTotalDeJogos($totalDeJogos);

        } catch (Exception $e) {
            echo 'Alerta!  ',  $e->getMessage(), "\n";
        }
    }

    protected function getQuantidadeDeDezenas(){
        return $this->quantidadeDeDezenas;
    }

    protected function setQuantidadeDeDezenas($quantidadeDeDezenas){
        $this->quantidadeDeDezenas = $quantidadeDeDezenas;
    }

    protected function getResultado(){
        return $this->resultado;
    }

    protected function setResultado($resultado){
        $this->resultado = $resultado;
    }

    protected function getTotalDeJogos(){
        return $this->totalDeJogos;
    }

    protected function setTotalDeJogos($totalDeJogos){
        $this->totalDeJogos = $totalDeJogos;
    }

    protected function getJogos(){
        return $this->jogos;
    }

    protected function setJogos($jogos){
        $this->jogos = $jogos;
    }

    private function dezenasUmASessenta(){
        for($i=1;$i<=60;$i++){
            $arrayDezenas[$i] = $i;
        }
        return $arrayDezenas;
    }

    public function arrayDeJogos(){
        for($i=0;$i<$this->totalDeJogos;$i++){
            $jogos[$i] = $this->quantidadeDeDezenas[$i];
        }
        $this->setJogos($jogos);
    }

    public function sorteiSeisDezenas(){
        $sorteioSeisDezenas = array_rand($this->dezenasUmASessenta(), 6);
        $this->setResultado($sorteioSeisDezenas);
    }

    public function imprimeResultado(){
        $this->sorteiSeisDezenas();
        $this->arrayDeJogos();
        $html ='
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        ';
        $html .= '<table class="table">';
        $html .= '<tr><th>Resultado -> </th>';
        for($i=0;$i<count($this->resultado);$i++){
            $html .= '<th>'.$this->resultado[$i].'</th>';
        }
        $html .= '<th>Total de Acertos</th></tr>';

        for($i=0;$i<count($this->jogos);$i++){
            $html .= '<tr><td>Jogo: '.($i + 1).' -> </td>';
            $this->jogos[$i]; 
            $h = 0;
            for($j=0;$j < count($this->jogos[$i]); $j++){
                if (in_array($this->jogos[$i][$j], $this->resultado)) { 
                    $html .= '<td><b>'.$this->jogos[$i][$j].'</b></td>';
                    $h++;
                }else{
                    $html .= '<td>'.$this->jogos[$i][$j].'</td>';
                }
            }
            
            $html .= '<td>'.$h.'</td></tr>';
        }
        $html .= '</table>';
        return $html;
    }


}
$quantidadeDeDezenas = array(
    array(10,17,45,38,34,60),
    array(1,13,45,28,16,36),
    array(23,12,23,18,58,56),
    array(7,17,49,59,56,28)
);

$execute = new TesteMonetizze($quantidadeDeDezenas,count($quantidadeDeDezenas));
$res = $execute->imprimeResultado();
echo $res;
