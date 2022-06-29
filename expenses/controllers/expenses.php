<?php

require_once "models/expensesmodel.php";
require_once "models/categoriesmodel.php";

class Expenses extends SessionController
{

    private $user;

    function __construct()
    {
        parent::__construct();

        $this->user = $this->getUserSessionData();
    }

    //para obtener los datos del user en su vista html
    function render()
    {
        $this->view->render("expenses/index", [
            "user" => $this->user
        ]);
    }

    function newExpense()
    {
        if (!$this->existPOST(["tittle", "amount", "category", "date"])) {
            $this->redirect("dashboard", []); //TODO: error
            return;
        }

        if ($this->user == NULL) {
            $this->redirect("dashboard", []); //TODO: error
            return;
        }

        $expense = new ExpensesModel();

        $expense->setTitle($this->getPost("title"));
        $expense->setAmount($this->getPost("amoun"));
        $expense->setCategoryid($this->getPost("category"));
        $expense->setDate($this->getPost("date"));
        $expense->setUserid($this->user->getId());

        $expense->save();
        $this->redirect("dashboard", []); //TODO: succes

    }


    function create()
    {
        $categories = new CategoriesModel();
        $this->view->render("expenses/create", [
            "categories" => $categories->getAll(),
            "user" => $this->user
        ]);
    }

    function getCategoriesId()
    {
        $joinModel = new JoinExpensesCategoriesModel();
        $categories = $joinModel->getAll($this->user->getId());

        $res = [];

        foreach ($categories as $cat) {
            array_push($res, $cat->getCategoryId());
        }

        $res = array_values(array_unique($res));

        return $res;
    }

    private function getDateList()
    {
        $months = [];
        $res = [];
        $joinModel = new JoinExpensesCategoriesModel();
        $expenses = $joinModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($months, substr($expense->getDate(), 0, 7));
        }

        $months = array_values(array_unique($months));

        if (count($months) > 3) {
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
            array_push($res, array_pop($months));
        }
        return $res;
    }

    function getCategoryList()
    {
        $res = [];
        $joinModel = new JoinExpensesCategoriesModel();
        $expenses = $joinModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->getNameCategory());
        }

        $res = array_values(array_unique($res));

        return $res;
    }

    function getCategoryColorList()
    {
        $res = [];
        $joinModel = new JoinExpensesCategoriesModel();
        $expenses = $joinModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->getColor());
        }

        $res = array_unique($res);

        $res = array_values(array_unique($res));

        return $res;
    }

    function getHistoryJSON()
    {
        header("Content-Type: application/json");
        $res = [];
        $joinModel = new JoinExpensesCategoriesModel();
        $expenses = $joinModel->getAll($this->user->getId());

        foreach ($expenses as $expense) {
            array_push($res, $expense->toArray());
        }

        echo json_encode($res);
    }

    function getExpensesJSON()
    {
        header("Content-Type: application/json");

        $res = [];
        $categoryIds = $this->getCategoriesId();
        $categoryNames = $this->getCategoryList();
        $categoryColors = $this->getCategoryColorList();

        array_unshift($categoryNames, "mes");
        array_unshift($categoryColors, "categories");

        $months = $this->getDateList();

        for ($i = 0; $i < count($months); $i++) {
            $item = array($months[$i]);
            for ($j = 0; $j < count($categoryIds); $j++) {
                $total = $this->getTotalByMonthAndCategory($months[$i], $categoryIds[$j]);
                array_push($item, $total);
            }
            array_push($res, $item);
        }

        array_unshift($res, $categoryNames);
        array_unshift($res, $categoryColors);
        echo json_encode($res);
    }

    private function getTotalByMonthAndCategory($date, $categoryid)
    {
        $iduser = $this->user->getId();
        //$expenses = new ExpensesModel();

        //$total = $expenses->getTotalByMonthAndCategory($date, $categoryid, $iduser);
        $total = $this->model->getTotalByMonthAndCategory($date, $categoryid, $iduser);

        if ($total == NULL) {
            $total = 0;
        }

        return $total;
    }

    function delete($params)
    {
        if ($params == NULL) {
            $this->redirect("expenses", []); //TODO: error
        }

        $id = $params[0];
        $res = $this->model->delete($id);

        if ($res) {
            $this->redirect("expenses", []);  //TODO: success
        } else {
            $this->redirect("expenses", []);  //TODO: error
        }
    }
}