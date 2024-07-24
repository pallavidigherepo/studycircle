<?php
namespace App\Repositories\Interfaces;

Interface QuestionRepositoryInterface {

    public function all($request);

    public function create($data);

    public function show($data);

    public function update($data, $question);

    public function delete($question);

    public function __importQuestionInBulk();

    public function __createAndUpdateQuestion();

    public function __createAndUpdateAnswer();

    public function __createAnswer();

    public function __updateAnswer();

    public function  __fetchQuestionForPaperGeneration();

}