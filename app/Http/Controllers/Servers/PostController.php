<?php

namespace App\Http\Controllers\Servers;

use App\Classes\Nestedsetbie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\{
    StorePostRequest,
    UpdatePostRequest
};

use App\Services\Interfaces\PostServiceInterface as PostService;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;



class PostController extends Controller
{
    protected $postService;
    protected $postRepository;
    protected $nestedset;
    protected $currentLanguage;


    // Sử dụng dependency injection chuyển đổi đối tượng của một lớp được đăng ký trong container
    public function __construct(
        PostService $postService,
        PostRepository $postRepository,
    ) {
        $this->postService = $postService;
        $this->postRepository = $postRepository;
        $this->nestedset = new Nestedsetbie([
            'table' => 'post_catalogues',
            'foreignkey' => 'post_catalogue_id',
            'language_id' => $this->currentLanguage()
        ]);
        $this->currentLanguage = $this->currentLanguage();
    }
    //
    function index()
    {
        $posts = $this->postService->paginate();
        // dd($posts);
        $config['seo'] = config('apps.post')['index'];


        return view('servers.posts.index', compact([
            'posts',
            'config'
        ]));
    }

    function create()
    {
        $config['seo'] = config('apps.post')['create'];
        $config['method'] = 'create';
        // Danh mục cha
        $dropdown = $this->nestedset->Dropdown();
        // dd($dropdown);
        return view('servers.posts.store', compact([
            'config',
            'dropdown',
        ]));
    }

    public function store(StorePostRequest $request)
    {
        if ($this->postService->create()) {
            return redirect()->route('post.index')->with('toast_success', 'Tạo bài viết mới thành công.');
        }
        return redirect()->route('post.create')->with('toast_error', 'Có lỗi vui lòng thử lại.');
    }

    public function edit($id)
    {
        // Gán id vào sesson
        session(['_id' => $id]);
        $post = $this->postRepository->getPostLanguageById($id, $this->currentLanguage());
        // dd($post);


        $albums =  json_decode($post->album);
        // Danh mục cha
        $dropdown = $this->nestedset->Dropdown();
        // dd($post);


        $config['seo'] = config('apps.post')['update'];
        $config['method'] = 'update';

        return view('servers.posts.store', compact([
            'config',
            'post',
            'albums',
            'dropdown',
        ]));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        // Lấy giá trị sesson
        $idPost = session('_id');
        if (empty($idPost)) {
            return redirect()->route('post.index')->with('toast_error', 'Có lỗi vui lòng thử lại.');
        }

        if ($this->postService->update($idPost)) {
            // Xoá giá trị sesson
            session()->forget('_id');
            return redirect()->route('post.index')->with('toast_success', 'Cập nhập bài viết thành công.');
        }
        // Xoá giá trị sesson
        session()->forget('_id');
        return redirect()->route('post.edit', $id)->with('toast_error', 'Có lỗi vui lòng thử lại.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->_id == null) {
            return redirect()->route('post.index')->with('toast_error', 'Có lỗi vui lòng thử lại');
        }
        if ($this->postService->destroy($request->_id)) {
            return redirect()->route('post.index')->with('toast_success', 'Xoá bài viết thành công.');
        }
        return redirect()->route('post.index')->with('toast_error', 'Có lỗi vui lòng thử lại.');
    }
}
