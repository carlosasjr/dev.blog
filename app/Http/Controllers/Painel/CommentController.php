<?php

namespace App\Http\Controllers\Painel;

use App\Events\CommentAnswered;
use App\Http\Controllers\ControllerStandard;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends ControllerStandard
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
        $this->title = 'Comentario';
        $this->view = 'painel.comments';
        $this->route = 'comentarios';
    }


    public function index()
    {
        $title = "Listagem de {$this->title}s";

        $data = $this->model->where('status', 'R')
            ->paginate($this->totalPage);

        return view("{$this->view}.index", compact('title', 'data'));
    }

    public function answers($id)
    {
        $comment = $this->model->with('answers.user')->find($id);

        $answers = $comment->answers;

        $title = 'Respostas Comentário: ' . $comment->name;

       return view('painel.comments.answers', compact('comment', 'title','answers'));

    }

    public function answersComment(Request $request, $id)
    {
        $this->validate($request, $this->model->rulesAnswerComment());

        $comment = $this->model->find($id);

        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $dataForm['date'] = date('Y-m-d');
        $dataForm['hour'] = date('H:i:s');

        $reply = $comment->answers()->create($dataForm);

        if (!$reply) {
            return redirect()->back()
                ->withErrors(['errors' => 'Falha ao registrar resposta'])
                ->withInput();
        }

        event(new CommentAnswered($comment, $reply));

        return redirect()->back()
                        ->with(['success' => 'Comentário enviado com sucesso.']);
    }

    public function destroyAnswer($idComentario, $idResposta)
    {
        $comment = $this->model->find($idComentario);

        $delete = $comment->answers()->find($idResposta)->delete();

        if (!$delete) {
            return redirect()->back()
                            ->withErrors('Falha ao deletar');
        }

        return redirect()->back()
                         ->with(['success' => 'Registro deletado com sucesso!']);
    }


    public function search(Request $request)
    {
        $dataForm = $request->except('_token');

        $data = $this->criteria($dataForm);

        return view("{$this->view}.index", compact('data', 'dataForm'));
    }

    /**
     * @param array $dataForm
     * @return mixed
     */
    protected function criteria(array $dataForm)
    {
        if (!empty($dataForm['pesquisa'])) {
            return $this->model->where('status', '=', "{$dataForm['status']}")
                ->where('name', 'like', "%{$dataForm['pesquisa']}%")
                ->orwhere('email', 'like', "%{$dataForm['pesquisa']}%")
                ->orwhere('description', 'like', "%{$dataForm['pesquisa']}%")
                ->paginate($this->totalPage);
        }

        return $this->model->where('status', '=', "{$dataForm['status']}")
            ->paginate($this->totalPage);

    }
}



