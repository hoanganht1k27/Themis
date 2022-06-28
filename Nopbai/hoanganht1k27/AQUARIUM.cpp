#include<bits/stdc++.h>
using namespace std;
const int N=1000004;
int m,H,K,Y[N];
struct hm
{
    double a,b,c;
};
hm sum[N];
double res[N],s[N];
int main()
{
    freopen("AQUARIUM.INP","r",stdin);
    freopen("AQUARIUM.OUT","w",stdout);
    scanf("%d%d",&m,&H);
    for(int i=0;i<=m;i++)
    {
        scanf("%d",&Y[i]);
        if(i>=1)
        {
            int x1=max(Y[i-1],Y[i]),x2=min(Y[i-1],Y[i]);
            if(x1!=x2)
            {sum[x2+1].b+=1/(double)(x1-x2);
            sum[x1+1].b-=1/(double)(x1-x2);
            sum[x2+1].c-=((double)(2*x2+1)/(double)(2*x1-2*x2));
            sum[x1+1].c+=((double)(2*x2+1)/(double)(2*x1-2*x2));}
            s[x1+1]++;
        }
    }
    for(int i=1;i<=H;i++)
    {
        sum[i].b+=sum[i-1].b;
        sum[i].c+=sum[i-1].c;
        s[i]+=s[i-1];
        double y=(double)i;
        res[i]=y*sum[i].b+sum[i].c+res[i-1]+s[i];
    }
    scanf("%d",&K);
    cout<<fixed<<setprecision(4);
    for(int i=1;i<=K;i++)
    {
        scanf("%d",&m);
        cout<<res[m]<<endl;
    }
}
