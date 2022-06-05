<?php
enum StadisticsRanges{
    case Development;
    case GreatPower;
    case Income;
    case Professionalism;
    case ArmyLimit;
    case Innovation;
    case Manpower;
    case AverageDevelopment;
    case OverallSpent;
    case ManpowerRecovery;
    case Provinces;
    // case Absolutism;
    case ArmyStrength;
    case TotalValue;
    // case NavalStrength;
    case MonarchPointsSpent;
    case ArmyQuality;
    case AdvisorsSpent;
    case AverageDevelopmentCost;
    case DevelopmentClicks;
    // case AveragteGobermentPoints;
    case CountryForce;

    public function range(){
        return match($this){
            StadisticsRanges::Development => "Seguimiento!B9:J{RANGE}",
            StadisticsRanges::GreatPower => "Seguimiento!M9:U{RANGE}",
            StadisticsRanges::Income => "Seguimiento!X9:AF{RANGE}",
            StadisticsRanges::Professionalism => "Seguimiento!AI9:AQ{RANGE}",
            StadisticsRanges::ArmyLimit => "Seguimiento!AT9:BB{RANGE}",
            StadisticsRanges::Innovation => "Seguimiento!BE9:BM{RANGE}",
            StadisticsRanges::Manpower => "Seguimiento!BP9:BX{RANGE}",
            StadisticsRanges::AverageDevelopment => "Seguimiento!CA9:CI{RANGE}",
            StadisticsRanges::OverallSpent => "Seguimiento!CL9:CT{RANGE}",
            StadisticsRanges::ManpowerRecovery => "Seguimiento!CW9:DE{RANGE}",
            StadisticsRanges::Provinces => "Seguimiento!DH9:DP{RANGE}",
            // StadisticsRanges::Absolutism => "Seguimiento!DS9:EA{RANGE}",
            StadisticsRanges::ArmyStrength => "Seguimiento!ED9:EL{RANGE}",
            StadisticsRanges::TotalValue => "Seguimiento!EO9:EW{RANGE}",
            // StadisticsRanges::NavalStrength => "Seguimiento!EZ9:FH{RANGE}",
            StadisticsRanges::MonarchPointsSpent => "Seguimiento!FK9:FS{RANGE}",
            StadisticsRanges::ArmyQuality => "Seguimiento!FV9:GD{RANGE}",
            StadisticsRanges::AdvisorsSpent => "Seguimiento!GG9:GO{RANGE}",
            StadisticsRanges::AverageDevelopmentCost => "Seguimiento!GR9:GZ{RANGE}",
            StadisticsRanges::DevelopmentClicks => "Seguimiento!HC9:HK{RANGE}",
            // StadisticsRanges::AveragteGobermentPoints => "Seguimiento!HN9:HV{RANGE}",
            StadisticsRanges::CountryForce => "Seguimiento!HY9:IG{RANGE}"
        };
    }

    public function name(){
        return match($this){
            StadisticsRanges::Development => "Development",
            StadisticsRanges::GreatPower => "GreatPower",
            StadisticsRanges::Income => "Income",
            StadisticsRanges::Professionalism => "Professionalism",
            StadisticsRanges::ArmyLimit => "ArmyLimit",
            StadisticsRanges::Innovation => "Innovation",
            StadisticsRanges::Manpower => "Manpower",
            StadisticsRanges::AverageDevelopment => "AverageDevelopment",
            StadisticsRanges::OverallSpent => "OverallSpent",
            StadisticsRanges::ManpowerRecovery => "ManpowerRecovery",
            StadisticsRanges::Provinces => "Provinces",
            // StadisticsRanges::Absolutism => "Absolutism",
            StadisticsRanges::ArmyStrength => "ArmyStrength",
            StadisticsRanges::TotalValue => "TotalValue",
            // StadisticsRanges::NavalStrength => "NavalStrength",
            StadisticsRanges::MonarchPointsSpent => "MonarchPointsSpent",
            StadisticsRanges::ArmyQuality => "ArmyQuality",
            StadisticsRanges::AdvisorsSpent => "AdvisorsSpent",
            StadisticsRanges::AverageDevelopmentCost => "AverageDevelopmentCost",
            StadisticsRanges::DevelopmentClicks => "DevelopmentClicks",
            // StadisticsRanges::AveragteGobermentPoints => "AveragteGobermentPoints",
            StadisticsRanges::CountryForce => "CountryForce"
        };
    }
}