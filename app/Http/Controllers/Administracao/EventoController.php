<?php

namespace App\Http\Controllers\Administracao;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\StandardController;
use App\Models\Administracao\Evento;
use App\Models\Administracao\Palestrante;
use App\Models\Administracao\Anexo;
use JansenFelipe\Utils\Utils as Utils;
use JansenFelipe\Utils\Mask as Mask;
use Carbon\Carbon as Date;

class EventoController extends StandardController
{
    protected $model;
    protected $nameView = 'administracao.eventos';
    protected $redirectCad = '/administracao/evento/cadastrar';
    protected $redirectEdit = '/administracao/evento/editar';
    protected $route = '/administracao/eventos';
    protected $request;
    protected $anexo;
    protected $palestrante;

    public function __construct(Evento $evento, Request $request, Palestrante $palestrante,Anexo $anexo)
    {
        $this->model = $evento;
        $this->request = $request;
        $this->palestrante = $palestrante;
        $this->anexo = $anexo;
    }

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
        $palestrantes = $this->palestrante->get();

        return view("{$this->nameView}.form-cad-edit", compact('palestrantes'));
    }

    /**
     * Exibe o formulário de cadastro
     *
     * @return type
     */
    public function formEditar($id)
    {
        $palestrantes = $this->palestrante->get();

        //Recupera o estilo pelo ID
        $data = $this->model->find($id);

       // dd($data->dt_inicio);

        $data->dt_inicio_br     = $data->dt_inicio->format('d/m/Y');
        $data->dt_fim_br        = $data->dt_fim->format('d/m/Y');

        return view("{$this->nameView}.form-cad-edit", compact('data'), compact('palestrantes'));
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

        //Arquivo de imagem vinda do formulário
        $imagem = $this->request->file('imagem');

        //Caminho da pasta onde as imagens irão ficar
        $path_imagem = public_path('uploads/imagens/eventos');

        //Nome do arquivo
        $nomeImagem = date('YmdHms') . '.' . $imagem->getClientOriginalExtension();

        //Faz upload da imagem
        $upload = $imagem->move($path_imagem, $nomeImagem);

        if (!$upload)
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao fazer o upload']);

        $dadosForm['imagem'] = $nomeImagem;

        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $this->model->roles);

        //Verifica se ocorreu erro.
        if ($validator->fails()) {
            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                ->withErrors($validator)
                ->withInput();
        }

        $dt_inicio = Date::createFromFormat('d/m/Y', $dadosForm['dt_inicio']);
        $dadosForm['dt_inicio'] = $dt_inicio->format('Y-m-d h:i:s');

        $dt_inicio = Date::createFromFormat('d/m/Y', $dadosForm['dt_fim']);
        $dadosForm['dt_fim'] = $dt_inicio->format('Y-m-d h:i:s');

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
     * Editando o estilo musical
     *
     * @return type
     */
    public function salvarEdicao($id)
    {
        //Recupera os dados do form
        $dadosForm = $this->request->all();

        //Realiza a validação dos dados.
        $validator = validator($dadosForm, $this->model->rolesEdit);

        //Verifica se ocorreu erro.
        if ($validator->fails()) {
            //Retorna as informações do erro.
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors($validator)
                ->withInput();
        }

        //Recupera o estilo pelo ID
        $item = $this->model->find($id);

        if ($this->request->hasFile('imagem') && $this->request->file('imagem')->isValid()) {

            //Arquivo de imagem vinda do formulário
            $imagem = $this->request->file('imagem');

            //Caminho da pasta onde as imagens irão ficar
            $path_imagem = public_path('uploads/imagens/eventos');

            //Nome do arquivo
            $nomeImagem = $item->imagem;

            $dadosForm['imagem'] = $nomeImagem;

            //Faz upload da imagem
            $upload = $imagem->move($path_imagem, $nomeImagem);

            if (!$upload)
                return redirect($this->redirectCad)
                    ->withErrors(['errors' => 'Falha ao fazer o upload']);


        }

        $dt_inicio = Date::createFromFormat('d/m/Y', $dadosForm['dt_inicio']);
        $dadosForm['dt_inicio'] = $dt_inicio->format('Y-m-d h:i:s');

        $dt_inicio = Date::createFromFormat('d/m/Y', $dadosForm['dt_fim']);
        $dadosForm['dt_fim'] = $dt_inicio->format('Y-m-d h:i:s');

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


    public function anexarMaterial($id){

        $evento = $this->model->find($id);

        $arquivos = $this->anexo->where('id_evento',$id)->get();

        return view("{$this->nameView}.anexo" , compact('id' , 'evento' , 'arquivos'));

    }

    public function salvarAnexo(){

        //Recupera os dados do form
        $dadosForm = $this->request->all();

        if ($this->request->hasFile('arquivo') && $this->request->file('arquivo')->isValid()) {

            //Arquivo de vinda do formulário
            $arquivo = $this->request->file('arquivo');

            //Caminho da pasta onde as imagens irão ficar
            $path_arquivo = public_path('uploads/materiais');

            //Nome do arquivo
            $nomeArquivo = date('YmdHms') . '.' . $arquivo->getClientOriginalExtension();

            $dadosForm['link'] = $nomeArquivo;

            //Faz upload da arquivo
            $upload = $arquivo->move($path_arquivo, $nomeArquivo);

            if (!$upload)
                return redirect($this->redirectCad)
                    ->withErrors(['errors' => 'Falha ao fazer o upload']);

        }

        //Faz o insert
        $insert = $this->anexo->create($dadosForm);

        //Verifica se deu tudo certo
        if ($insert) {
            return back();
        } else {

            //Retorna as informações do erro.
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar'])
                ->withInput();
        }


    }

    public function excluirAnexo($id){

        $anexo = $this->anexo->find($id);

        //Caminho da pasta onde as imagens irão ficar
        $path_arquivo = public_path('uploads/materiais/');


        \File::delete($path_arquivo.$anexo->link);

        //Faz o insert
        $delete = $this->anexo->destroy($id);

        //Verifica se deu tudo certo
        if ($delete) {
            return redirect($this->route);
        } else {

            //Retorna as informações do erro.
            return redirect($this->route)
                ->withErrors(['errors' => 'Falha ao Excluir o Anexo!'])
                ->withInput();
        }


    }



}
