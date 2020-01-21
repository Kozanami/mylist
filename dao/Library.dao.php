<?php 
require_once('modele/Library.class.php');

class DaoLibrary {
    
    public function read($userid,$firstEntry,$category = null) {
        if($category != null)
        {
            $datas = DB::request('SELECT * FROM library WHERE userid=? AND category=?  ORDER BY id LIMIT '.$firstEntry.', '.$_SESSION['entityByPage'].'',array($userid,$category));

        }
        else
        {
            $datas = DB::request('SELECT * FROM library WHERE userid=? ORDER BY id LIMIT '.$firstEntry.', '.$_SESSION['entityByPage'].'',array($userid));
        }

        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                $tabLibrary[$key] = new Library($data['name'],$data['category'],$data['subcategory'],$data['season'],$data['smax'],$data['episode'],$data['epmax'],$data['tag'],$data['evaluation'],$data['note'],$data['userid']);
                $tabLibrary[$key]->setId($data['id']);
                $tabLibrary[$key]->setName($data['name']);
                $tabLibrary[$key]->setCategory($data['category']);
                $tabLibrary[$key]->setSubcategory($data['subcategory']);
                $tabLibrary[$key]->setSeason($data['season']);
                $tabLibrary[$key]->setSmax($data['smax']);
                $tabLibrary[$key]->setEpisode($data['episode']);
                $tabLibrary[$key]->setEpmax($data['epmax']);
                $tabLibrary[$key]->setTag($data['tag']);
                $tabLibrary[$key]->setEvaluation($data['evaluation']);
                $tabLibrary[$key]->setNote($data['note']);
                $tabLibrary[$key]->setUserId($data['userid']);
            }  
            return $tabLibrary;
        } else {
            return null;
            }
    }

    public function readOne($id) {
        $datas = DB::request('SELECT * FROM library WHERE id=?',array($id));
        if (!empty($datas)) {
            foreach ($datas as $key => $data) {
                $tabLibrary[$key] = new Library($data['name'],$data['category'],$data['subcategory'],$data['season'],$data['smax'],$data['episode'],$data['epmax'],$data['tag'],$data['evaluation'],$data['note'],$data['userid']);
                $tabLibrary[$key]->setId($data['id']);
                $tabLibrary[$key]->setName($data['name']);
                $tabLibrary[$key]->setCategory($data['category']);
                $tabLibrary[$key]->setSubcategory($data['subcategory']);
                $tabLibrary[$key]->setSeason($data['season']);
                $tabLibrary[$key]->setSmax($data['smax']);
                $tabLibrary[$key]->setEpisode($data['episode']);
                $tabLibrary[$key]->setEpmax($data['epmax']);
                $tabLibrary[$key]->setTag($data['tag']);
                $tabLibrary[$key]->setEvaluation($data['evaluation']);
                $tabLibrary[$key]->setNote($data['note']);
                $tabLibrary[$key]->setUserId($data['userid']);
            }  
            return $tabLibrary;
        } else {
            return null;
            }
    }

    public function create($library) {
        DB::request('INSERT INTO library (name,category,subcategory,season,smax,episode,epmax,tag,evaluation,note,userid) VALUES (?,?,?,?,?,?,?,?,?,?,?)', array($library->getName(),$library->getCategory(),$library->getSubcategory(),$library->getseason(),$library->getSmax(),$library->getEpisode(),$library->getEpmax(),$library->getTag(),$library->getEvaluation(),$library->getNote(),$library->getUserId()));
        $library->setId(DB::lastId());
        return $library;
    }

    public function update($library,$id){
        DB::request('UPDATE library SET name = ?,category = ?, subcategory = ?,season = ?,smax = ?, episode = ?,epmax = ?, tag = ?, evaluation = ?, note = ?, userid = ? WHERE id = ?', array($library->getName(),$library->getCategory(),$library->getSubcategory(),$library->getseason(),$library->getSmax(),$library->getEpisode(),$library->getEpmax(),$library->getTag(),$library->getEvaluation(),$library->getNote(),$library->getUserId(),$id
        ));
    }

    public function delete($id) {
        DB::request('DELETE FROM library WHERE id=?',array($id));
    }

    public function countLibrary($userid,$category = null)
    {
        if($category != null)
        {
            $count =  DB::request('SELECT COUNT(*) FROM library WHERE userid = ? AND category=?',array($userid,$category));
        }
        else
        {
            $count =  DB::request('SELECT COUNT(*) FROM library WHERE userid = ?',array($userid));
        }

        return $count[0]['COUNT(*)'];
    }
}

 ?>