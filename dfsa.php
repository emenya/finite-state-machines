<?php
/**
*@edmond menya
*edmondmenya@gmail.com
*deterministic finite state automaton
*/
function d_recognize($tape,$machine_tt){//the string and the DFSA state-transition table both in array data structure 
	$index=0;
	$current_state=0;
	$transition_table = $machine_tt;
	$length_of_tape=count($tape);	
	$machine = New Machine;
	$final_states = $machine->final_states();

	while($index<=$length_of_tape){//loop through all content in the tape
		if($index==$length_of_tape){//end of the tape has been reached
			if(in_array($current_state,$final_states)){
				return true;//accept tape
			}else{
				return false;//reject tape
			}
		}elseif(!isset($transition_table[$current_state][$tape[$index]])){//empty transition
			return false;
		}else{//main algorithm
			$current_state=$transition_table[$current_state][$tape[$index]];
			$index=$index+1;//move to next window in tape
		}
	}
}

Class Machine{//DFSA 5 tuple definition
	
	
	function states(){
		$states = array(0,1,2,3,4);
		return $states;
	}
	
	function alphabet(){
		$alphabet = array('b','a','!');
		return $alphabet;
	}
	
	function start_state(){
		$start_state = array(0);
		return $start_state;
	}
	
	function final_states(){
		$final_states = array(4);
		return $final_states;
	}
	
	function transition_table(){
		$transition_table = array();
		$transition_table[0]['b']=1;
		$transition_table[1]['a']=2;
		$transition_table[2]['a']=3;
		$transition_table[3]['a']=3;
		$transition_table[3]['!']=4;
				
		return $transition_table;
	}
		
}

function recognize($string){
	$machine = New Machine;
	$machine = $machine->transition_table();
	$tape = str_split($string);
	
	if(d_recognize($tape,$machine)){
		echo "String accepted";
	}else{
		echo "string rejected";
	}
}

echo recognize('baa!');//run DFSA from here by inputing the string
