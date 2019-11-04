echo '
 <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th>
                      <th class="column-title">Server Name </th>
                      <th class="column-title">Application </th>
                      <th class="column-title">Status </th>
                      <th class="column-title no-link last"><span class="nobr">Action</span>
                      </th>
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                      </th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                      </td>
                      <td class=" ">SOA_1</td>
                      <td class=" ">FMW </td>
                      <td class=" ">RUNNING <i class="success fa fa-long-arrow-up"></i></td>
                      <td class=" last"><a href="#">View</a>
                      </td>
                    </tr>
                    <tr class="odd pointer">
                      <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                      </td>
                      <td class=" ">SOA_2</td>
                      <td class=" ">FMW</td>
                      <td class=" ">RUNNING<i class="success fa fa-long-arrow-up"></i>
					  <td class=" last"><a href="#">View</a>
                      </td>
                   
                    </tr>
                    <tr class="even pointer">
                      <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                      </td>
                      <td class=" ">SOA_2</td>
                      <td class=" ">FMW</td>
                      <td class=" ">RUNNING <i class="success fa fa-long-arrow-up"></i>
					  <td class=" last"><a href="#">View</a>
                      </td>
                  
                    </tr>
                   
                  </tbody>
                </table>
              </div>
			  <div class="x_content">
              <button type="button" class="btn btn-default">Status</button>

              <button type="button" class="btn btn-primary">Info</button>

              <button type="button" class="btn btn-success">Start</button>

              <button type="button" class="btn btn-info">Restart</button>

              <button type="button" class="btn btn-warning">Rolling Restart</button>

              <button type="button" class="btn btn-danger">Stop</button>

            </div>
'
