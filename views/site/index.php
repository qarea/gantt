<?php

/* @var $this yii\web\View */

use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8 gantt-container">
                <svg id="gantt"></svg>
            </div>
            <div class="col-lg-4">
                <h2>Redesing website</h2>

                <?= Html::beginForm() ?>

                    <div class="form-group">
                        <?= Html::label('Start Date', 'start_date') ?>
                        <?= Html::input('text', 'date', null, ['id' => 'start_date', 'class' => 'form-control']) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::label('Duration (days)', 'duration') ?>
                        <?= Html::input('text', 'duration', null, ['id' => 'duration', 'class' => 'form-control']) ?>
                    </div>

                <?= Html::endForm() ?>

                <script>
                    var names = [
                        ["Redesign website", [0, 7]],
                        ["Write new content", [1, 4]],
                        ["Apply new styles", [3, 6]],
                        ["Review", [7, 7]],
                        ["Deploy", [8, 9]],
                        ["Go Live!", [10, 10]]
                    ];

                    var selected_task;

                    var tasks = names.map(function(name, i) {
                        var today = new Date();
                        var start = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                        var end = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                        start.setDate(today.getDate() + name[1][0]);
                        end.setDate(today.getDate() + name[1][1]);
                        return {
                            start: start,
                            end: end,
                            name: name[0],
                            id: "Task " + i,
                            progress: parseInt(Math.random() * 100, 10)
                        }
                    });
                    tasks[1].dependencies = "Task 0";
                    tasks[2].dependencies = "Task 1";
                    tasks[3].dependencies = "Task 2";
                    tasks[5].dependencies = "Task 4";

                    var gantt = new Gantt("#gantt", tasks, {
                        on_click: function (task) {
                            selected_task = task;
                            var duration = (task._end.diff(task._start, 'hours') + 24) / gantt.config.step;

                            $("#start_date").val(moment(task.start).format('YYYY-MM-DD'));
                            $("#duration").val(duration);
                        }
                    });

                    $("#start_date").on("change", function() {
                        var task = gantt.tasks[selected_task._index];

                        task.start = moment($(this).val()).toDate();
                        gantt.refresh(gantt.tasks);

                        var duration = (task._end.diff(task._start, 'hours') + 24) / gantt.config.step;
                        $("#duration").val(duration);
                    });

                    $("#duration").on("change", function() {
                        var task = gantt.tasks[selected_task._index];
                        var duration = 86400000 * (parseInt($(this).val()) - 1);

                        task.end.setTime(task.start.getTime() + duration);

                        gantt.refresh(gantt.tasks);
                    });
                </script>
            </div>
        </div>

    </div>
</div>
