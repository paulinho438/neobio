<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\Produtos;
use App\Models\Categoria;
use App\Models\User;
use App\Models\Pedidos;

use Illuminate\Support\Facades\Http;


class ProdutoController extends Controller
{
    public function add(Request $request){
        $array = ['error' => ''];
        if($request->input('event')){
            $dados = $request->input('event');
            $produto = Produtos::create($dados);
            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/geral/produtos/', [
                'call' => 'ConsultarProduto',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'param' => [['codigo_produto' => $dados['codigo_produto']]]
            ]);
            $res = $response->json();

            $produto->url_imagem = $res['imagens'][0]['url_imagem'];
            $produto->save();

            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/geral/familias/', [
                'call' => 'PesquisarFamilias',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'param' => [['pagina' => 1, 'registros_por_pagina' => 50]]
            ]);

            $res = $response->json();
            $info = [];
            foreach($res['famCadastro'] as $item){
                $info[] = [
                    'codigo_familia' => $item['codigo'],
                    'descricao' => $item['nomeFamilia']
                ];
            }

            Categoria::upsert($info, ['codigo_familia', 'descricao'], ['descricao']);


            
        }
        return $array;
    }

    public function edit(Request $request){
        $array = ['error' => ''];
        if($request->input('event')){
            $dados = $request->input('event');
            $produto = Produtos::where('codigo_produto', $dados['codigo_produto'])->update($dados);
            
            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/geral/produtos/', [
                'call' => 'ConsultarProduto',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'param' => [['codigo_produto' => $dados['codigo_produto']]]
            ]);
            $res = $response->json();
            $produto = Produtos::where('codigo_produto', $dados['codigo_produto'])->get();
            $produto[0]->url_imagem = $res['imagens'][0]['url_imagem'];
            $produto[0]->save();

            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/geral/familias/', [
                'call' => 'PesquisarFamilias',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'param' => [['pagina' => 1, 'registros_por_pagina' => 50]]
            ]);

            $res = $response->json();
            $info = [];
            foreach($res['famCadastro'] as $item){
                $info[] = [
                    'codigo_familia' => $item['codigo'],
                    'descricao' => $item['nomeFamilia']
                ];
            }

            Categoria::upsert($info, ['codigo_familia', 'descricao'], ['descricao']);


            
        }
        return $array;
    }

    public function delete(Request $request){
        $array = ['error' => ''];
        if($request->input('event')){
            $dados = $request->input('event');
            $del = Produtos::where('codigo_produto', $dados['codigo_produto'])->get();
            if($del){
                $del[0]->delete();
            }
            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/geral/familias/', [
                'call' => 'PesquisarFamilias',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'param' => [['pagina' => 1, 'registros_por_pagina' => 50]]
            ]);
            $res = $response->json();
            $info = [];
            foreach($res['famCadastro'] as $item){
                $info[] = [
                    'codigo_familia' => $item['codigo'],
                    'descricao' => $item['nomeFamilia']
                ];
            }
            Categoria::upsert($info, ['codigo_familia', 'descricao'], ['descricao']);
        }
        return $array;
    }

    public function meusPedidosApk(Request $request){
        $array = ['error' => '', 'pedidos' => []];
            $user = auth()->user();
            $array['pedidos'] = Pedidos::where('codigo_cliente', $user->id)->get();
        return $array;
    }

    public function novoPedidoApk(Request $request){
        $array = ['error' => ''];
        $validator = Validator::make($request->all(), [
            'produtos' => 'required',
        ]);
        $dados = $request->all();
        if(!$validator->fails()){
            $user = auth()->user();
            
            $arrayPedido = [
                'codigo_cliente' => $user->id,
                'dateCreate' => date('Y-m-d')
            ];
            $novoPedido = Pedidos::create($arrayPedido);

            $produtos_e_quantidades = explode(',', $dados['produtos']);
            $produtos_formatado = [];
            $produtos_e_qt_formatado = [];
            foreach($produtos_e_quantidades as $item){
                $res = explode(':', $item);
                $produtos_formatado[] = $res[0];
                $produtos_e_qt_formatado[$res[0]] = $res[1];
            }
            $produtos = Produtos::whereIn('codigo_produto', $produtos_formatado)->get();
            $arrayOmie = [
                'call' => 'IncluirPedido',
                'app_key' => '1695006304992',
                'app_secret' => 'dd0c6cf4a760c5552efff107f6e73704',
                'cabecalho' => [
                    'codigo_cliente'=> $user->codigo_cliente_omie,
                    'codigo_pedido_integracao'=> $novoPedido['id'],
                    'data_previsao'=> date('d/m/Y'),
                    'etapa'=> '10',
                    'numero_pedido'=> $novoPedido['id'],
                    'codigo_parcela'=> '999',
                    'quantidade_itens'=> count($produtos)
                ],
                'det' => [],
                'informacoes_adicionais' => [
                    'codigo_categoria'=> '1.01.01',
                    'codigo_conta_corrente'=> 3315640982,
                    'enviar_email'=> 'N'
                ]
            ];

            foreach($produtos as $item){
                $arrayOmie['det'][] = [
                    'ide'=> [
                        'codigo_item_integracao'=> $item['id']
                      ],
                      'produto'=> [
                        'codigo_produto'=> $item['codigo_produto'],
                        'descricao'=> $item['descricao'],
                        'ncm'=> $item['ncm'],
                        'quantidade'=> $produtos_e_qt_formatado[$item['codigo_produto']],
                        'tipo_desconto'=> 'V',
                        'unidade'=> $item['unidade'],
                        'valor_desconto'=> 0,
                        'valor_unitario'=> $item['valor_unitario']
                      ]
                ];
            }

            $response = Http::acceptJson()->post('https://app.omie.com.br/api/v1/produtos/pedido/', $arrayOmie);
            $res = $response->json();

            $produtos->codigo_pedido = $res['codigo_pedido'];
            $produtos->save();
        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }
        return $array;
    }

    

    public function clienteAdd(Request $request){
        $array = ['error' => ''];
        if($request->input('event')){
            $dados = $request->input('event');
            $arrTags = [];        
            foreach($dados['tags'] as $item) {
            $arrTags[] = $item['tag'];
            }
            $tags = implode(',', $arrTags);
            $dados['tags'] = $tags;
            $dados['password'] = password_hash('neobio', PASSWORD_DEFAULT);
            User::create($dados);
        }
        return $array;
    }

    public function clienteEdit(Request $request){
        $array = ['error' => ''];
        if($request->input('event')){
            $dados = [];
            $dados['bairro'] = $request->input('event')['bairro'];
            $dados['bloqueado'] = $request->input('event')['bloqueado'];
            $dados['bloquear_faturamento'] = $request->input('event')['bloquear_faturamento'];
            $dados['cep'] = $request->input('event')['cep'];
            $dados['cidade'] = $request->input('event')['cidade'];
            $dados['cnae'] = $request->input('event')['cnae'];
            $dados['cnpj_cpf'] = $request->input('event')['cnpj_cpf'];
            $dados['codigo_cliente_integracao'] = $request->input('event')['codigo_cliente_integracao'];
            $dados['codigo_cliente_omie'] = $request->input('event')['codigo_cliente_omie'];
            $dados['codigo_pais'] = $request->input('event')['codigo_pais'];
            $dados['complemento'] = $request->input('event')['complemento'];
            $dados['contato'] = $request->input('event')['contato'];
            $dados['contribuinte'] = $request->input('event')['contribuinte'];
            $dados['email'] = $request->input('event')['email'];
            $dados['endereco'] = $request->input('event')['endereco'];
            $dados['endereco_numero'] = $request->input('event')['endereco_numero'];
            $dados['estado'] = $request->input('event')['estado'];
            $dados['exterior'] = $request->input('event')['exterior'];
            $dados['fax_ddd'] = $request->input('event')['fax_ddd'];
            $dados['fax_numero'] = $request->input('event')['fax_numero'];
            $dados['homepage'] = $request->input('event')['homepage'];
            $dados['inativo'] = $request->input('event')['inativo'];
            $dados['inscricao_estadual'] = $request->input('event')['inscricao_estadual'];
            $dados['inscricao_municipal'] = $request->input('event')['inscricao_municipal'];
            $dados['inscricao_suframa'] = $request->input('event')['inscricao_suframa'];
            $dados['logradouro'] = $request->input('event')['logradouro'];
            $dados['nif'] = $request->input('event')['nif'];
            $dados['nome_fantasia'] = $request->input('event')['nome_fantasia'];
            $dados['obs_detalhadas'] = $request->input('event')['obs_detalhadas'];
            $dados['observacao'] = $request->input('event')['observacao'];
            $dados['optante_simples_nacional'] = $request->input('event')['optante_simples_nacional'];
            $dados['pessoa_fisica'] = $request->input('event')['pessoa_fisica'];
            $dados['produtor_rural'] = $request->input('event')['produtor_rural'];
            $dados['razao_social'] = $request->input('event')['razao_social'];
            $dados['recomendacao_atraso'] = $request->input('event')['recomendacao_atraso'];
            $dados['telefone1_ddd'] = $request->input('event')['telefone1_ddd'];
            $dados['telefone1_numero'] = $request->input('event')['telefone1_numero'];
            $dados['telefone2_ddd'] = $request->input('event')['telefone2_ddd'];
            $dados['telefone2_numero'] = $request->input('event')['telefone2_numero'];
            $dados['tipo_atividade'] = $request->input('event')['tipo_atividade'];
            $dados['valor_limite_credito'] = $request->input('event')['valor_limite_credito'];
            
            $arrTags = [];        
            foreach($request->input('event')['tags'] as $item) {
                $arrTags[] = $item['tag'];
            }
            $tags = implode(',', $arrTags);
            $dados['tags'] = $tags;

            User::where('codigo_cliente_omie', $dados['codigo_cliente_omie'])->update($dados);
        }
        return $array;
    }

    public function allProdutos(Request $request) {
        $array = ['error' => '', 'list' => [], 'categorias' => []];
        $produtos = Produtos::all();
        foreach($produtos as $item){
            $array['list'][] = [
                'id' => $item['id'],
                'name' => $item['descricao'],
                'rating' => 0,
                'categories' => [intval($item['codigo_familia'])],
                'priceRating' => 1,
                'photo' => $item['url_imagem'],
                'duration' => '',
                'menu' =>[
                    [
                        'menuId' => $item['id'],
                        'name' => $item['descricao'],
                        'photo' => $item['url_imagem'],
                        'description' => $item['descr_detalhada'],
                        'calories' => 0,
                        'price' => 0
                    ]
                ] 
            ];

        }

        $categorias = Categoria::all();
        foreach($categorias as $item){
            $array['categorias'][] = [
                'id' => intval($item['codigo_familia']),
                'name' => $item['descricao'],
                'icon' => $item['url_image'],
            ];
        }


        
        return $array;
    }
}
