    <form id="jump-to-date-form">
        <h4>
            Go to date
            <span class="btn btn-dark float-right mb-2 element-close" data-element=".jump-to-date">X</span>
        </h4>
        <div class="mt-2 form-group">
            <select name="period" class="form-control" id="jump-to-date-period">
                <option value="Day">day</option>
                <option value="Week">week</option>
                <option value="Month">month</option>
                <option value="Year">year</option>
            </select>
        </div>
        <div class="form-group">
            <input type="date" name="date" class="form-control" id="jump-to-date-day">
        </div>
        <div class="form-group">
            <input type="submit" name="go-to-date" class="form-control btn btn-primary" value="Go to date"
                id="jump-to-date-submit">
        </div>
    </form>
