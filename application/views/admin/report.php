<style>
    .check-icon {
        position: absolute;
        margin-left: -25px;
    }
    
    .icon-badge {
        background: black;
        padding: 10px;
        border-radius: 50%;
        color: white;
    }  

    .my-div{
        margin: 5px;
    }
</style>
<div class="container">
    <?php $this->view('templates/banner'); ?>
    <?php $this->view('templates/admin-tab'); ?>
    <h2 class="text-center"><?= $title ?></h2>
    <h3 class="text-center"><?= $sub_heading; ?></h3>
    <div class="table-wrap">

        <div>
            <label>Select Month : </label>
            <select class="select-month-report">
                <option value="">Select Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <label>Year : </label>
            <input type="number" class="filter-year"/>
            <button class="btn btn-green btn-filter-report" type="button">Filter</button>
        </div>
        <div class="my-div">
            <span><i class="fas fa-user icon-badge"></i> <?= count($cgmc_ojt_pending); ?> On-the-Job Training</span>
        </div>
        <div class="my-div">
            <span><i class="fas fa-suitcase icon-badge"></i> <?= count($cgmc_ja_pending); ?> Employment, Licensure Examination and Further Studies</span>
        </div>
        <div class="my-div">
            <span><i class="fas fa-certificate icon-badge"></i> <?= count($cgmc_ss_pending); ?> Scholarship</span>
        </div>
        <div class="my-div">
            <span><i class="fas fa-exchange-alt icon-badge"></i> <?= count($cgmc_tf_pending); ?> Transferring Students</span>
        </div>
        <div class="my-div">
            <span><i class="fas fa-medal icon-badge"></i> <?= count($cgmc_ta_pending); ?> Ten Outstanding Students Awards (TOSA) Application </span>
        </div>
        <div class="my-div">
            <span><i class="fas fa-sort-amount-up-alt icon-badge"></i> <?= count($cgmc_rnur_pending); ?> Students who will represent the University in Regional/ National/ International Competitions </span>
        </div>

        <div class="my-div">
            <span><i class="fas fa-users icon-badge"></i> <?= count($counseling); ?> Group Counseling</span>
        </div>

        <div class="my-div">
            <span><i class="fas fa-user-graduate icon-badge"></i> <?= count($exit_interview); ?> Exit Interview</span>
        </div>

        <div class="my-div">
            <span><i class="fas fa-tasks icon-badge"></i> <?= count($initial_interview); ?> OJT Initial Interview</span>
        </div>

        <div class="my-div">
            <span><i class="fas fa-tasks icon-badge"></i> <?= count($post_interview); ?> OJT Post Interview</span>
        </div>
    </div>
    <p class="text-center">*** Nothing Follows ***</p>
</div>
<?php //print_r($data_table); ?>
<!-- <div class="form-container"></div> -->
<div class="update-form-modal custom-modal">
    <div class="modal-wrap">
        <div class="modal-box">
            <div class="modal-header">Update Form</div>
            <div class="modal-body"></div>
        </div>
    </div>
    <div class="modal-bg-overlay"></div>
</div>

<script>
    var url_parts = location.pathname.split("/");
    if (url_parts.length == 5 && !isNaN(url_parts[3]) && !isNaN(url_parts[4])){
    document.getElementsByClassName("select-month-report")[0].value = url_parts[3]; 
    document.getElementsByClassName("filter-year")[0].value = url_parts[4]; 
    }
</script>