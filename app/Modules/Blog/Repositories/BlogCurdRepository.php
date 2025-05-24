<?php

namespace App\Repositories;
use App\Interfaces\DesignInterface;

class BlogCrudRepository implements DesignInterface
{   

    /**
     * @inheritDoc
     */
    public function mainData()
    {
        return [
            'title' => trans('Blog::blog.title'),
            'url' => 'dashboard/'.'blogs',
            'name' => 'blogs',
            'nameOne' => 'blog',
            'modelName' => 'Blog',
            'icon' => ' fas fa-envelope-open-text',
            'sortName' => '',
            'addOne' => trans('Blog::blog.newOne'),
        ];
    }

    /**
     * @inheritDoc
     */
    public function toggleData(): array
    {
        return  [
            'status' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showInActive'),
                'checked' => true,
            ],
            'deleted_at' => [
                'type' => 'toggle',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Dashboard::dashboard.showItems'),
                'checked' => false,
            ],
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function searchData(): array
    {
        return  [
            'date' => [
                'type' => 'text',
                'class' => 'form-control datatable-input',
                'index' => '',
                'label' => trans('Blog::blog.form.date'),
            ],
            'category_id' => [
                'type' => 'select',
                'class' => 'form-control datatable-input',
                'index' => '3',
                'label' => trans('Blog::blog.form.category'),
                'options' => \App\Entities\Category::where('status',1)->get(['id',"name_".LANGUAGE_PREF." as title"]),
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function tableData()
    {
        return [
            'id' => [
                'label' => trans('Dashboard::dashboard.id'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
            'image' => [
                'label' => trans('Dashboard::dashboard.image'),
                'type' => 'image',
                'className' => '',
                'data-col' => 'image_url',
                'anchor-class' => '',
            ],
            'title_ar' => [
                'label' => trans('Section::section.form.title_ar'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'name_ar',
                'anchor-class' => 'editable',
            ],
            'title_en' => [
                'label' => trans('Section::section.form.title_en'),
                'type' => '',
                'className' => 'edits',
                'data-col' => 'name_en',
                'anchor-class' => 'editable',
            ],
            'views' => [
                'label' => trans('Blog::blog.form.views'),
                'type' => '',
                'className' => '',
                'data-col' => 'views',
                'anchor-class' => '',
            ],
            'date' => [
                'label' => trans('Blog::blog.form.date'),
                'type' => '',
                'className' => '',
                'data-col' => 'date',
                'anchor-class' => '',
            ],
            'category_name' => [
                'label' => trans('Blog::blog.form.category'),
                'type' => '',
                'className' => '',
                'data-col' => 'category_id',
                'anchor-class' => '',
            ],
            'status' => [
                'label' => trans('Section::section.form.status'),
                'type' => '',
                'className' => '',
                'data-col' => 'status',
                'anchor-class' => '',
            ],
            'actions' => [
                'label' => trans('Dashboard::dashboard.actions'),
                'type' => '',
                'className' => '',
                'data-col' => '',
                'anchor-class' => '',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    public function addData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function editData()
    {
        return[
            
        ];
    }

    /**
     * @inheritDoc
     */
    public function getSpecificData($types=[])
    {
        $data = [];
        if(in_array('main',$types)){
            $data['mainData'] = $this->mainData();
        }

        if(in_array('search',$types)){
            $data['searchData'] = $this->searchData();
            $data['toggleData'] = $this->toggleData();
        }

        if(in_array('table',$types)){
            $data['tableData'] = $this->tableData();
        }

        if(in_array('add',$types)){
            $data['modelData'] = $this->addData();
        }

        if(in_array('edit',$types)){
            $data['modelData'] = $this->editData();
        }

        if(in_array('all',$types)){
            $data = [
                'mainData' => $this->mainData(),
                'searchData' => $this->searchData(),
                'toggleData' => $this->toggleData(),
                'tableData' => $this->tableData(),
                'modelData' => $this->addData(),
            ];
        }
        return $data;
    }
}
