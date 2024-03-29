#!/bin/ksh -f

RUSER=$1
RHOST=$2

        if [ -z "${RHOST}" ]
        then
                echo "\nUsage: $0 remoteUserName remoteHostName\n"

                exit 22
        fi

        if [ ! -f ${HOME}/.ssh/id_rsa.pub ]
        then
                echo "SSH not configured for user ${LOGNAME} - creating key..."

                ssh-keygen -trsa -N "" -f ~/.ssh/id_rsa

                STATUS=$?

                if [[ ${STATUS} -ne 0 ]]
                then
                        echo "SSH configuration FAILED for ${LOGNAME}"
                        exit ${STATUS}
                fi

                chmod 755 ${HOME}
        fi

        echo "SSH configured for ${LOGNAME} OK."

        echo "Processing ${RUSER}..."

        scp ~/.ssh/id_rsa.pub ${RUSER}@${RHOST}:id_rsa.pub.hotfix

        STATUS=$?

        if [[ ${STATUS} -ne 0 ]]
        then
                echo "scp of public key file to ${RUSER}@${RHOST} FAILED!"

                exit ${STATUS}
        fi

        ssh ${RUSER}@${RHOST} "
                if [ ! -f \${HOME}/.ssh/id_rsa.pub ]
                then
                        ssh-keygen -trsa -N \"\" -f ~/.ssh/id_rsa
                fi

                cat \${HOME}/id_rsa.pub.hotfix >> \${HOME}/.ssh/authorized_keys
                chmod 600 \${HOME}/.ssh/authorized_keys
                chmod 700 \${HOME}/.ssh/
                chmod 755 \${HOME}
        "

        STATUS=$?

        if [[ ${STATUS} -ne 0 ]]
        then
                echo "Adding SSH public key to user ${RUSER} FAILED!."
                exit ${STATUS}
        fi

        echo "Added SSH public key to user ${RUSER}."
#-------------------------------------------------------------------------
#       E       O       F
#-------------------------------------------------------------------------


