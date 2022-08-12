<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * CategoriesItems Controller
 *
 * @property \App\Model\Table\CategoriesItemsTable $CategoriesItems
 *
 * @method \App\Model\Entity\CategoriesItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesItemsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->validateAccess($this->Auth->user());
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }

    public function beforeRender(Event $event)
    {
    }

    public function index($category_id)
    {
        $this->set('page_title', 'Manage Category items');
        $this->loadModel('Categories');
        $categories = $this->Categories->find('all')
            ->where(['id' => $category_id])->first();

        $categories_list = $this->paginate(
            $this->CategoriesItems->find('all')->where(['category_id' => $category_id])
        );

        if (empty($categories)) {
            return $this->redirect(['controller' => 'categories']);
        }

        $this->set(compact('categories'));
        $this->set(compact('categories_list'));
    }

    public function add($category_id)
    {
        $category_item = $this->CategoriesItems->newEntity();
        if ($this->request->is('post')) {
            $category_item = $this->CategoriesItems->patchEntity($category_item, $this->request->getData());
            $category_item->category_id = $category_id;

            if ($this->CategoriesItems->save($category_item)) {
                $this->loggerIt('CategoriesItems', 'add', $this->Auth->user('id'), $category_item, 'Categories Items Add');
                $this->Flash->formsuccess(__('The category item has been saved.'));
                return $this->redirect(['action' => 'index', $category_id]);
            } else {
                $this->loggerIt('CategoriesItems', 'add', $this->Auth->user('id'), $category_item, 'Categories Items Add Failed');
                $this->Flash->formerror(__('The category item could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('category'));
    }

    public function delete($category_id)
    {
        $this->autorender = false;
        $this->autolayout = false;

        if ($this->request->is(['post'])) {
            $category = $this->CategoriesItems->get($category_id);
            $updated_status = 0;

            if (!empty($category)) {
                $logged_role = $this->Auth->user('role_id');
                $logged_roles = $this->Auth->user('roles');

                if ($logged_roles['CategoriesItems']['action_delete'] === 1) {
                    if ($category->status === 0) {
                        $updated_status = 1;
                    }
                    $category->status = $updated_status;

                    if ($this->CategoriesItems->save($category)){
                        $this->loggerIt('CategoriesItems', 'delete', $this->Auth->user('id'), $category, 'Category Items Edit Status (Delete)'); 
                        $this->Flash->formsuccess(__('The category item status has been updated.'));
                    } else {
                        $this->loggerIt('CategoriesItems', 'delete', $this->Auth->user('id'), $category, 'Category Items Edit Status Failed (Delete)');
                        $this->Flash->formsuccess(__('The category item status was not updated.'));
                    }
              
                } else {
                    $this->Flash->formerror(__('You are not authorized to deactivate this category'));
                }
            } else {
                $this->Flash->formerror(__('Category not found'));
            }
        }

        return $this->redirect($this->referer());
    }

}