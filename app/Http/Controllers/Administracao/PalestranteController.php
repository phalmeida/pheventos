<?php

namespace App\Http\Controllers\Administracao;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Palestrante;
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;

class PalestranteController extends StandardController
{

    protected $model;
    protected $nameView = 'administracao.palestrantes';
    protected $redirectCad = '/administracao/palestrante/cadastrar';
    protected $redirectEdit = '/administracao/palestrante/editar';
    protected $route = '/administracao/palestrantes';
    protected $request;

    public function __construct(Palestrante $palestrante, Request $request)
    {
        $this->model = $palestrante;
        $this->request = $request;
    }

    /**
     * Lista dos intens
     * 
     * @return typeos 
     */
    public function index()
    {
        //Recupera todos os dados.
        $data = $this->model->select('id', 'nome', 'email', \DB::raw('CASE WHEN LENGTH(telefone) = 10 
                                                        THEN 
                                                            CONCAT("(", SUBSTRING(telefone,1, 2), ")" , " ", SUBSTRING(telefone,3, 4), "-", SUBSTRING(telefone,7, 4) )
                                                        ELSE 
                                                            CONCAT("(", SUBSTRING(telefone,1, 2), ")" , " ", SUBSTRING(telefone,3, 5), "-", SUBSTRING(telefone,8, 4) ) 
                                                END  AS telefone'))
                ->paginate(10);

        return view("{$this->nameView}.index", compact('data'));
    }

    /**
     * Realiza o cadastro
     * 
     * @return type
     */
    public function salvarCadastro()
    {
        //Recupera os dados do formulário    
        $dadosForm = $this->request->all();

        //Retira a máscara do telefone
        $dadosForm['telefone'] = Utils::unmask($dadosForm['telefone']);

        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $this->model->roles);

        //Verifica se ocorreu erro.
        if ($validator->fails()) {
            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                            ->withErrors($validator)
                            ->withInput();
        }

        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //Verifica se deu tudo certo
        if ($insert) {
            return redirect($this->route);
        } else {

            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                            ->withErrors(['errors' => 'Falha ao cadastrar'])
                            ->withInput();
        }
    }

    /**
     * Editando o Palestrante
     * 
     * @return type
     */
    public function salvarEdicao($id)
    {
        //Recupera os dados do form
        $dadosForm = $this->request->all();

        //Retira a máscara do telefone
        $dadosForm['telefone'] = Utils::unmask($dadosForm['telefone']);

        //Regras personalizadas para edição dos registros.
        $roles_edit = [
            'nome' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100|email|unique:palestrantes,email,' . $id,
            'telefone' => 'required|min:10|max:11'
        ];

        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $roles_edit);

        //Verifica se ocorreu erro.
        if ($validator->fails()) {
            //Retorna as informações do erro.
            return redirect("{$this->redirectEdit}/$id")
                            ->withErrors($validator)
                            ->withInput();
        }

        //Recupera o palestrante pelo ID
        $item = $this->model->find($id);

        //Faz a edição do item
        $update = $item->update($dadosForm);

        //Verifica se editou com sucesso
        if ($update) {
            return redirect($this->route);
        } else {

            //Retorna as informações do erro.
            return redirect("{$this->redirectEdit}/$id")
                            ->withErrors(['errors' => 'Falha ao Editar'])
                            ->withInput();
        }
    }

    /**
     * Realiza a pesquisa
     * 
     */
    public function pesquisar()
    {

        $palavraPesquisa = $this->request->get('pesquisar');
        $data = $this->model->select('id', 'nome', 'email', \DB::raw('CASE WHEN LENGTH(telefone) = 10 
                                                        THEN 
                                                            CONCAT("(", SUBSTRING(telefone,1, 2), ")" , " ", SUBSTRING(telefone,3, 4), "-", SUBSTRING(telefone,7, 4) )
                                                        ELSE 
                                                            CONCAT("(", SUBSTRING(telefone,1, 2), ")" , " ", SUBSTRING(telefone,3, 5), "-", SUBSTRING(telefone,8, 4) ) 
                                                END  AS telefone'))
                        ->where('nome', 'LIKE', "%$palavraPesquisa%")->paginate(10);

        return view("{$this->nameView}.index", compact('data'), compact('palavraPesquisa'));
    }

}
