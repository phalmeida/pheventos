<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

/**
 * Class StandardController responsavel por inserir, atualizar e deletar os arquivos
 * ela é uma classe genérica.
 * 
 * @author Philipe Allan Almeida
 */
class StandardController extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
    protected $totalPorPagina;
    

    /**
     * Lista dos intens
     * 
     * @return typeos 
     */
    public function index()
    {
        //Recupera todos os dados.
        $data = $this->model->paginate($this->totalPorPagina);
        return view("{$this->nameView}.index", compact('data'));
    }

    /**
     * Exibe o formulário de cadastro
     * 
     * @return type
     */
    public function formCadastro() 
    {
        return view("{$this->nameView}.form-cad-edit");
    }
    
    /** 
     * Exibe o formulário de cadastro
     * 
     * @return type
     */
    public function formEditar($id) 
    {
        //Recupera o estilo pelo ID
        $data = $this->model->find($id);
        return view("{$this->nameView}.form-cad-edit", compact('data'));
    }
    
    /**
     * Editando o estilo musical
     * 
     * @return type
     */
    public function salvarEdicao($id) 
    {
        //Recupera os dados do form
        $dadosForm = $this->request->all();

        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $this->model->roles);
        
        //Verifica se ocorreu erro.
        if($validator->fails()){
            //Retorna as informações do erro.
            return redirect("{$this->redirectEdit}/$id")
                                ->withErrors($validator)
                                ->withInput();
        }
        
        //Recupera o estilo pelo ID
        $item = $this->model->find($id);
        
        //Faz a edição do item
        $update = $item->update($dadosForm);
        
        //Verifica se editou com sucesso
        if( $update ){
            return redirect($this->route);
        }else{
            
            //Retorna as informações do erro.
            return redirect("{$this->redirectEdit}/$id")
                                ->withErrors(['errors' => 'Falha ao Editar'])
                                ->withInput();
        }
        
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
        
        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $this->model->roles);
        
        //Verifica se ocorreu erro.
        if($validator->fails()){
            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                                ->withErrors($validator)
                                ->withInput();
        }
        
        //Faz o insert
        $insert = $this->model->create($dadosForm);
        
        //Verifica se deu tudo certo
        if( $insert ){
            return redirect($this->route);
        }else{
            
            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                                ->withErrors(['errors' => 'Falha ao cadastrar'])
                                ->withInput();
        }
    }
    
    /**
     * Deleta um registro
     * 
     */
    public function delete($id)
    {
        //recupera o item pelo id
        $item = $this->model->find($id);
        
        //Deleta o item
        $deleta = $item->delete();
        
        return redirect($this->route);
        
    }   
    
    /**
     * Realiza a pesquisa
     * 
     */
    public function pesquisar()
    {

        $palavraPesquisa = $this->request->get('pesquisar');
        $data = $this->model->where('nome','LIKE',"%$palavraPesquisa%")->paginate(10);
       
        return view("{$this->nameView}.index", compact('data'), compact('palavraPesquisa'));
        
    }         
    
}

