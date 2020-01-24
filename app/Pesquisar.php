<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesquisar extends Model
{
    public static function Buscar($request){
        
        //Monta a url
        $externa = "https://www.seminovos.com.br/";
        
        //Filtro veículo
        if($request->veiculo == "carro") $externa .= "carro";
        if($request->veiculo == "moto") $externa .= "moto";
        if($request->veiculo == "caminhao") $externa .= "caminhao";

        //Filtros
        if($request->marca) $externa .= "/".$request->marca;
        if($request->modelo) $externa .= "/".$request->modelo;
        if($request->anos) $externa .= "/".$request->anos;
        if($request->km) $externa .= "/".$request->km;


        //Maior quantidade de registros possíveis
        $externa .= "?registrosPagina=50";
        //Extrai a página
        $resultados = file_get_contents($externa);

        //array com os dados que vou pegar
        $array_dados['url'] = array('inicio' => '<meta itemprop="url" content="', 'fim' => '">');
        $array_dados['bodyType'] = array('inicio' => '<span itemprop="bodyType">', 'fim' => '</span>');
        $array_dados['brand'] = array('inicio' => '<span itemprop="brand">', 'fim' => '</span>');
        $array_dados['model'] = array('inicio' => '<span itemprop="model">', 'fim' => '</span>');
        $array_dados['name'] = array('inicio' => '<span itemprop="name">', 'fim' => '</span>');
        $array_dados['description'] = array('inicio' => '<span itemprop="description">', 'fim' => '</span>');
        $array_dados['mileageFromOdometer'] = array('inicio' => '<span itemprop="mileageFromOdometer">', 'fim' => '</span>');
        $array_dados['ano_fabricacao'] = array('inicio' => "<li title=\"Ano de fabricação\">\n<i class=\"icon icon-calendar\"></i>\n", 'fim' => ' </li>');
        $array_dados['price'] = array('inicio' => '<span itemprop="price">', 'fim' => '</span>');
        $array_dados['priceCurrency'] = array('inicio' => '<meta itemprop="priceCurrency" content="', 'fim' => '">');
        $array_dados['priceValidUntil'] = array('inicio' => '<span class="d-none" itemprop="priceValidUntil">', 'fim' => '</span>');
        $array_dados['image'] = array('inicio' => '<img itemprop="image" src="', 'fim' => '" alt');

        //extrai os dados do veiculo
        $aux1 = explode('<meta itemprop="productID"',$resultados);
        foreach ($aux1 as $key => $value) {
            if ($key == 0) continue;

            $sku = strstr($value,'<span itemprop="sku">');
            $sku = strstr($sku,'</span>',true);
            $sku = str_replace('<span itemprop="sku">','',$sku);

            $compilado[$sku]["sku"] = $sku;

            foreach ($array_dados as $nome => $dados) {
                $aux2 = strstr($value,$dados["inicio"]);
                $aux2 = strstr($aux2,$dados["fim"],true);
                $aux2 = str_replace($dados["inicio"],'',$aux2);

                $compilado[$sku]["$nome"] = $aux2;
            }
        }

        return response()->json($compilado, 200);

    }
}
