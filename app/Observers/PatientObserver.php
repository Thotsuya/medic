<?php

namespace App\Observers;

use App\Models\Map;
use App\Models\Patient;
use App\Models\Timeline;
use App\Models\Tooth;
use Carbon\Carbon;

class PatientObserver
{
    public function created(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-green"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido registrado en el sistema</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
        $this->createOdontogram($patient);
    }

    /**
     * Handle the Patient "updated" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function updated(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-info"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Se modificaron los datos del paciente <a href="#">'.$patient->name.'</a></h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Patient "deleted" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function deleted(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-danger"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido dado de baja</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    /**
     * Handle the Patient "restored" event.
     *
     * @param  \App\Models\Patient  $patient
     * @return void
     */
    public function restored(Patient $patient)
    {
        //
        $timeline = new Timeline();
        $timeline->content = '<div>
        <i class="fas fa-user bg-info"></i>
        <div class="timeline-item">
          <span class="time"><i class="fas fa-clock"></i> '.Carbon::now()->translatedFormat('g:i A').'</span>
          <h3 class="timeline-header no-border">Paciente <a href="#">'.$patient->name.'</a> ha sido dado de alta</h3>
        </div>
        </div>';
        $patient->timeline()->save($timeline);
    }

    private function createOdontogram(Patient $patient){

        $odontograma = new Tooth();
        $odontograma->canvar = '<table class="table">
        <tbody>
            <tr align="center">
              <td>18</td><td>17</td><td>16</td><td>15</td>
              <td>14</td><td>13</td><td>12</td><td>11</td><td></td><td></td><td>21</td>
              <td>22</td><td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td>
          </tr>
          <tr>
            <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td></td>
                <td></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
          </tr>
          <tr align="center">
              <td></td><td></td><td></td><td>55</td><td>54</td><td>53</td>
              <td>52</td><td>51</td><td></td><td></td><td>61</td><td>62</td>
              <td>63</td><td>64</td><td>65</td><td></td><td></td><td></td>
          </tr>
          <tr>
              <td></td><td></td><td></td>
               <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td></td><td></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td></td><td></td><td></td>
          </tr>
          <tr align="center">
              <td></td><td></td><td></td><td>85</td><td>84</td><td>83</td>
              <td>82</td><td>81</td><td></td><td></td><td>71</td><td>72</td>
              <td>73</td><td>74</td><td>75</td><td></td><td></td><td></td>
          </tr>
                <tr>
              <td></td><td></td><td></td>
               <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td></td><td></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                 <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                <td></td><td></td><td></td>
          </tr>
                <tr align="center">
              <td>48</td><td>47</td><td>46</td><td>45</td>
              <td>44</td><td>43</td><td>42</td><td>41</td><td></td><td></td><td>31</td>
              <td>32</td><td>33</td><td>34</td><td>35</td><td>36</td><td>37</td><td>38</td>
          </tr>
          <tr>
            <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente agregar"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                <td></td>
                <td></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                  <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
                <td><svg height="50" width="50">
                <polygon points="10,10 50,10 40,20 20,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,10 50,50 40,40 40,20" estado="0" value="pd2" class="diente agregar"></polygon>
                <polygon points="50,50 10,50 20,40 40,40" estado="0" value="pd3" class="diente agregar"></polygon>
                <polygon points="10,50 20,40 20,20 10,10" estado="0" value="pd4" class="diente agregar"></polygon>
                <polygon points="20,20 40,20 40,40 20,40" estado="0" value="pd5" class="diente"></polygon>
                </svg></td>
          </tr>
        </tbody>
      </table>';
        $odontograma->numbdiente = 85; //No se para que es esto xD
        $odontograma->patient_id = $patient->id;
        $odontograma->save();

        Map::create([
            'boton' => '  <table class="table">
        <tbody><tr>
         <td><div class="btn btn-warning btn0" id="styleSpan" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn1" id="styleSpan2" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn2" id="styleSpan3" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn3" id="styleSpan4" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn4" id="styleSpan5" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn5" id="styleSpan6" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         </tr>

         <tr>
         <td><div class="btn btn-warning btn6" id="styleSpan7" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn7" id="styleSpan8" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn8" id="styleSpan9" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn9" id="styleSpan10" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn10" id="styleSpan11" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn11" id="styleSpan12" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         </tr>
         <tr>
         <td><div class="btn btn-warning btn12" id="styleSpan13" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn13" id="styleSpan14" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn14" id="styleSpan15" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn15" id="styleSpan16" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn16" id="styleSpan17" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         <td><div class="btn btn-warning btn17" id="styleSpan18" style="background-color: rgb(236, 170, 57);">vacio</div></td>
         </tr>

        </tbody></table>',
            'nombtrata' => 'ECAA39',
            'classbtn1' => 'ECAA39',
            'classbtn2' => 'ECAA39',
            'classbtn3' => 'ECAA39',
            'classbtn4' => 'ECAA39',
            'classbtn5' => 'ECAA39',
            'classbtn6' => 'ECAA39',
            'classbtn7' => 'ECAA39',
            'classbtn8' => 'ECAA39',
            'classbtn9' => 'ECAA39',
            'classbtn10' => 'ECAA39',
            'classbtn11' => 'ECAA39',
            'classbtn12' => 'ECAA39',
            'classbtn13' => 'ECAA39',
            'classbtn14' => 'ECAA39',
            'classbtn15' => 'ECAA39',
            'classbtn16' => 'ECAA39',
            'classbtn17' => 'ECAA39',
            'classbtn18' => 'ECAA39',
            'patient_id' => $patient->id,
        ]);

        return true;

    }

}
