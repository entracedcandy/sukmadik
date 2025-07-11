
@extends('mahasiswa.layout')

@section('mhssection')
   

<div class="container">
  <div class="w-95 w-md-75 w-lg-60 w-xl-55 mx-auto mb-6 text-center">
    <div class="subtitle alt-font">
      <span class="text-primary">#04</span>
      <span class="title">Timetable</span>
    </div>
    <h2 class="display-18 display-md-16 display-lg-14 mb-0">
      Committed to fabulous and great <span class="text-primary">#Timetable</span>
    </h2>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="schedule-table">
        <table class="table bg-white">
          <thead>
            <tr>
              <th>Routine</th>
              <th>10 am</th>
              <th>11 am</th>
              <th>03 pm</th>
              <th>05 pm</th>
              <th class="last">07 pm</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="day">Sunday</td>
              <td class="active">
                <h4>Weight Loss</h4>
                <p>10 am - 11 am</p>
                <div class="hover">
                  <h4>Weight Loss</h4>
                  <p>10 am - 11 am</p>
                  <span>Wayne Ponce</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Yoga</h4>
                <p>03 pm - 04 pm</p>
                <div class="hover">
                  <h4>Yoga</h4>
                  <p>03 pm - 04 pm</p>
                  <span>Francisco Watt</span>
                </div>
              </td>
              <td class="active">
                <h4>Boxing</h4>
                <p>05 pm - 06 pm</p>
                <div class="hover">
                  <h4>Boxing</h4>
                  <p>05 pm - 046am</p>
                  <span>Charles King</span>
                </div>
              </td>
              <td></td>
            </tr>
            <tr>
              <td class="day">Monday</td>
              <td></td>
              <td class="active">
                <h4>Cycling</h4>
                <p>11 am - 12 pm</p>
                <div class="hover">
                  <h4>Cycling</h4>
                  <p>11 am - 12 pm</p>
                  <span>Tabitha Potter</span>
                </div>
              </td>
              <td class="active">
                <h4>Karate</h4>
                <p>03 pm - 05 pm</p>
                <div class="hover">
                  <h4>Karate</h4>
                  <p>03 pm - 05 pm</p>
                  <span>Lester Gray</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Crossfit</h4>
                <p>07 pm - 08 pm</p>
                <div class="hover">
                  <h4>Crossfit</h4>
                  <p>07 pm - 08 pm</p>
                  <span>Candi Yip</span>
                </div>
              </td>
            </tr>
            <tr>
              <td class="day">Tuesday</td>
              <td class="active">
                <h4>Spinning</h4>
                <p>10 am - 11 am</p>
                <div class="hover">
                  <h4>Spinning</h4>
                  <p>10 am - 11 am</p>
                  <span>Mary Cass</span>
                </div>
              </td>
              <td></td>
              <td></td>
              <td class="active">
                <h4>Bootcamp</h4>
                <p>05 pm - 06 pm</p>
                <div class="hover">
                  <h4>Bootcamp</h4>
                  <p>05 pm - 06 pm</p>
                  <span>Brenda Mastropietro</span>
                </div>
              </td>
              <td class="active">
                <h4>Boxercise</h4>
                <p>07 pm - 08 pm</p>
                <div class="hover">
                  <h4>Boxercise</h4>
                  <p>07 pm - 08 pm</p>
                  <span>Marlene Bruce</span>
                </div>
              </td>
            </tr>
            <tr>
              <td class="day">Wednesday</td>
              <td class="active">
                <h4>Body Building</h4>
                <p>10 am - 12 pm</p>
                <div class="hover">
                  <h4>Body Building</h4>
                  <p>10 am - 12 pm</p>
                  <span>Brenda Hester</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Dance</h4>
                <p>03 pm - 05 pm</p>
                <div class="hover">
                  <h4>Dance</h4>
                  <p>03 pm - 05 pm</p>
                  <span>Brian Ashworth</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Health</h4>
                <p>07 pm - 08 pm</p>
                <div class="hover">
                  <h4>Health</h4>
                  <p>07 pm - 08 pm</p>
                  <span>Mark Croteau</span>
                </div>
              </td>
            </tr>
            <tr>
              <td class="day">Thursday</td>
              <td></td>
              <td class="active">
                <h4>Bootcamp</h4>
                <p>11 am - 12 pm</p>
                <div class="hover">
                  <h4>Bootcamp</h4>
                  <p>1 am - 12 pm</p>
                  <span>Elisabeth Schreck</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Boday Building</h4>
                <p>05 pm - 06 pm</p>
                <div class="hover">
                  <h4>Boday Building</h4>
                  <p>05 pm - 06 pm</p>
                  <span>Edward Garcia</span>
                </div>
              </td>
              <td></td>
            </tr>
            <tr>
              <td class="day">Friday</td>
              <td class="active">
                <h4>Racing</h4>
                <p>10 am - 11 am</p>
                <div class="hover">
                  <h4>Racing</h4>
                  <p>10 am - 11 am</p>
                  <span>Jackie Potts</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Energy Blast</h4>
                <p>03 pm - 05 pm</p>
                <div class="hover">
                  <h4>Energy Blast</h4>
                  <p>03 pm - 05 pm</p>
                  <span>Travis Brown</span>
                </div>
              </td>
              <td></td>
              <td class="active">
                <h4>Jumping</h4>
                <p>07 pm - 08 pm</p>
                <div class="hover">
                  <h4>Jumping</h4>
                  <p>07 pm - 08 pm</p>
                  <span>Benjamin Barnett</span>
                </div>
              </td>
            </tr>
            <tr>
              <td class="day">Satarday</td>
              <td></td>
              <td></td>
              <td class="active">
                <h4>Aerobics</h4>
                <p>03 pm - 04 pm</p>
                <div class="hover">
                  <h4>Aerobics</h4>
                  <p>03 pm - 04 pm</p>
                  <span>Andre Walls</span>
                </div>
              </td>
              <td class="active">
                <h4>Cycling</h4>
                <p>05 pm - 06 pm</p>
                <div class="hover">
                  <h4>Cycling</h4>
                  <p>05 pm - 06 pm</p>
                  <span>Margaret Thomas</span>
                </div>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>




@endsection
