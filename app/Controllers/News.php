<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{  	
	 public function index() {
			$model = model(NewsModel::class);

			$data = [
				'news'  => $model->getNews(),
				'title' => 'News archive',
			];

             

			return view('templates/header', $data)
				. view('news/index')
				. view('templates/footer');
		}
		
		
		
		
	public function view($slug = null) {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }
    
    
    
    
    public function create() {
			$model = model(NewsModel::class);

			if ($this->request->getMethod() === 'post' && $this->validate([
				'title' => 'required|min_length[3]|max_length[255]',
				'body' => 'required', 
			])) { 
					 
			$avatar = $this->request->getFile('userfile');
			if($avatar->isValid()){
				//$avatar->store();
				$newName = $avatar->getRandomName();
				$avatar->move('asstes', $newName);
				  
			}   
				   
			$model->save([
				'title' => $this->request->getPost('title'),
				'slug'  => url_title($this->request->getPost('title'), '-', true),
				'body'  => $this->request->getPost('body'),
				'userfile'  => $newName,
			]);

			 //   return view('news/success');
				
				return redirect()->route('news'); 
			}

			return view('templates/header', ['title' => 'Create a news item'])
				. view('news/create')
				. view('templates/footer');
		}
		
		
		
    
     public function edit($slug = null) {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/edit')
            . view('templates/footer');
    }
    
    
    
    public function update($id = null) {
        $model = model(NewsModel::class);

        if ($this->request->getMethod() === 'post' && $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body' => 'required',
        ])) {

            //img update
            $avatar = $this->request->getFile('userfile');
			if($avatar->isValid()){
				//$avatar->store();
				$newName = $avatar->getRandomName();
				$avatar->move('asstes', $newName);

                //update img
                $oldimgName = $this->request->getPost('userfile');
                unlink('asstes/'.$oldimgName);
				  
			}else{
                $newName = $this->request->getPost('userfile');
            } 
           
           $data = [  
				'id' => $id,
                'title' => $this->request->getPost('title'),
                //'slug'  => url_title($this->request->getPost('title'), '-', true),
                'body'  => $this->request->getPost('body'),
                'userfile'  => $newName,
            ];            
            
           // $model->where('id', 6);
			$model->save($data);
			//$model->update($data, ['id' => $id]);
            
            //$model->update($slug,$data);

			return redirect()->route('news'); 
        }

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    }
    
    
    public function delete($id = null) {
        $model = model(NewsModel::class); 
        //find dataase img path
        $data['news'] = $model->where('id', $id)->first();
        $data['userfile'] = $data['news']['userfile'];

        //unlink('asstes/image_name.jpg');
        unlink('asstes/'.$data['userfile']);
        // var_dump($data['userfile']);
        // exit;        
		$model->where('id', $id);  
		$model->delete();
		return redirect()->route('news'); 
    }
    
    public function search() {
        $title = $this->request->getPost('search');

        $db = \Config\Database::connect();
        $db = db_connect();
        $query = $db->query('SELECT * FROM news WHERE title LIKE "%'.$title.'%"');         
       
        $data = [
            'news'  => $query->getResult('array'),
            'title' => 'Search',
        ];

        // var_dump($data);
        // exit;

        return view('templates/header', $data)
            . view('news/search')
            . view('templates/footer');
    }
    
    
}
