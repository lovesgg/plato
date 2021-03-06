<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BookCopy;

/**
 * BookCopySearch represents the model behind the search form of `common\models\BookCopy`.
 */
class BookCopySearch extends BookCopy
{
    public $title;
    public $bookseller_title;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bookseller_id', 'collection_place_id', 'circulation_type_id', 'call_number_rules_id', 'library_id', 'user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [[ 'book_id', 'bar_code', 'title', 'bookseller_title'], 'safe'],
            [['price1', 'price2'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = BookCopy::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('book');
        $query->joinWith('bookseller');
        $query->select("book_copy.*,book.title,bookseller.title");


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'bookseller_id' => $this->bookseller_id,
            'price1' => $this->price1,
            'price2' => $this->price2,
            'collection_place_id' => $this->collection_place_id,
            'circulation_type_id' => $this->circulation_type_id,
            'call_number_rules_id' => $this->call_number_rules_id,
            'library_id' => $this->library_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'bar_code', $this->bar_code])
            ->andFilterWhere(['like', 'book.title', $this->title])
            ->andFilterWhere(['like', 'book.isbn', $this->book_id])
            ->andFilterWhere(['like', 'bookseller.title', $this->bookseller_title]);

        return $dataProvider;
    }
}
