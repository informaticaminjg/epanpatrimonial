<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Relevamientopat_bien;

/**
 * Relevamientopat_bienSearch represents the model behind the search form of `app\models\Relevamientopat_bien`.
 */
class Relevamientopat_bienSearch extends Relevamientopat_bien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idrelevamiento'], 'integer'],
            [['matricula', 'persona_cargo', 'lugar_pertenece', 'estado_bien'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Relevamientopat_bien::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idrelevamiento' => $this->idrelevamiento,
        ]);

        $query->andFilterWhere(['like', 'matricula', $this->matricula])
            ->andFilterWhere(['like', 'persona_cargo', $this->persona_cargo])
            ->andFilterWhere(['like', 'lugar_pertenece', $this->lugar_pertenece])
            ->andFilterWhere(['like', 'estado_bien', $this->estado_bien]);

        return $dataProvider;
    }
}
