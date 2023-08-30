<?php

namespace App\Http\Livewire\Admin;

use App\Models\NoticeBoard;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Notice extends Component
{
  use WithPagination, WithFileUploads;
  public $addDialog = false;
  public $title;
  public $content;
  public $file;

  public $editId;
  public $updateDialog;
  public $deleteDialog;


  public function openAddDialog()
  {
    $this->addDialog = true;
  }

  public function addNotice()
  {
    $this->validate([
      'title' => 'required',
      'content' => 'required'
    ]);

    $noticeBoard = new NoticeBoard;
    $noticeBoard->title = $this->title;
    $noticeBoard->slug = Str::slug($this->title, '-');
    $noticeBoard->content = $this->content;
    if ($this->file != null) {
      $imageURL = $this->file->storePublicly('notice_attachments', 'public');
      $noticeBoard->file = $imageURL;
    }
    $noticeBoard->save();
    $this->addDialog = false;
    $this->reset('title', 'content', 'file');
  }

  public function openEditDialog($id, $title, $content)
  {
    $this->editId = $id;
    $this->title = $title;
    $this->content = $content;
    $this->updateDialog = true;
  }

  public function updateNotice()
  {
    $this->validate([
      'title' => 'required',
      'content' => 'required'
    ]);

    $noticeBoard = NoticeBoard::findOrFail($this->editId);
    $noticeBoard->title = $this->title;
    $noticeBoard->slug = Str::slug($this->title, '-');
    $noticeBoard->content = $this->content;
    if ($this->file != null) {
      $imageURL = $this->file->storePublicly('notice_attachments', 'public');
      $noticeBoard->file = $imageURL;
    }
    $noticeBoard->save();
    $this->updateDialog = false;

    $this->reset('title', 'content', 'file');
  }

  public function openDeleteDialog($id)
  {
    $this->deleteDialog = true;
    $this->editId = $id;
  }

  public function closeDeleteDialog()
  {
    $this->deleteDialog = false;
  }

  public function deleteNotice()
  {
    NoticeBoard::findOrFail($this->editId)->delete();
    $this->deleteDialog = false;
  }

  public function render()
  {
    return view('livewire.admin.notice', [
      'notices' => NoticeBoard::paginate(10),
    ]);
  }
}
